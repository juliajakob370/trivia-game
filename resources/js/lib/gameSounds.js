let sharedCtx = null;

function getCtx() {
    if (!sharedCtx) {
        const AudioContextClass = window.AudioContext || window.webkitAudioContext;
        sharedCtx = new AudioContextClass();
    }
    return sharedCtx;
}

function tone(freq, startOffset, duration, type = 'square', volume = 0.15) {
    const ctx = getCtx();
    const osc = ctx.createOscillator();
    const gain = ctx.createGain();
    osc.type = type;
    osc.frequency.value = freq;
    osc.connect(gain);
    gain.connect(ctx.destination);

    const start = ctx.currentTime + startOffset;
    gain.gain.setValueAtTime(volume, start);
    gain.gain.exponentialRampToValueAtTime(0.001, start + duration);
    osc.start(start);
    osc.stop(start + duration);
}

export function playCorrectSound() {
    try {
        tone(523, 0, 0.08, 'square');
        tone(659, 0.08, 0.08, 'square');
        tone(784, 0.16, 0.16, 'square');
    } catch {
        // Web Audio can throw if the browser hasn't unlocked it yet.
    }
}

export function playWrongSound() {
    try {
        tone(140, 0, 0.18, 'sawtooth', 0.18);
        tone(110, 0.15, 0.28, 'sawtooth', 0.18);
    } catch {
        // Web Audio can throw if the browser hasn't unlocked it yet.
    }
}
