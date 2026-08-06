export default function SoundToggleButton({ soundOn, onToggle }) {
    return (
        <button
            type="button"
            onClick={onToggle}
            aria-label={soundOn ? 'Mute sound' : 'Unmute sound'}
            aria-pressed={soundOn}
            className="absolute -bottom-4 -right-4 z-20 flex h-12 w-12 items-center justify-center rounded-full border-2 border-plum-dark bg-rose text-plum-dark shadow-md transition hover:bg-rose-dark focus:outline-none focus:ring-4 focus:ring-mauve"
        >
            {soundOn ? (
                <svg viewBox="0 0 24 24" fill="currentColor" className="h-6 w-6">
                    <path d="M11 5 6 9H3v6h3l5 4V5Z" />
                    <path
                        d="M15.54 8.46a5 5 0 0 1 0 7.07M18.36 5.64a9 9 0 0 1 0 12.72"
                        fill="none"
                        stroke="currentColor"
                        strokeWidth="1.5"
                        strokeLinecap="round"
                    />
                </svg>
            ) : (
                <svg viewBox="0 0 24 24" fill="currentColor" className="h-6 w-6">
                    <path d="M11 5 6 9H3v6h3l5 4V5Z" />
                    <path
                        d="m16 9 5 6M21 9l-5 6"
                        fill="none"
                        stroke="currentColor"
                        strokeWidth="1.5"
                        strokeLinecap="round"
                    />
                </svg>
            )}
        </button>
    );
}
