import { useState } from 'react';
import { Link } from '@inertiajs/react';

const NOTCH = 14;
const ART_NOTCH = 8;

const pixelClip = (notch) =>
    `polygon(0% ${notch}px, ${notch}px ${notch}px, ${notch}px 0%, calc(100% - ${notch}px) 0%, calc(100% - ${notch}px) ${notch}px, 100% ${notch}px, 100% calc(100% - ${notch}px), calc(100% - ${notch}px) calc(100% - ${notch}px), calc(100% - ${notch}px) 100%, ${notch}px 100%, ${notch}px calc(100% - ${notch}px), 0% calc(100% - ${notch}px))`;

export default function CategoryCard({ title, slug, icon, accentColor, href, highlightColor }) {
    const [artMissing, setArtMissing] = useState(false);
    const [gifMissing, setGifMissing] = useState(false);
    const [isHovering, setIsHovering] = useState(false);
    const [bouncing, setBouncing] = useState(false);
    const surfaceColor = highlightColor || accentColor;

    const showGif = isHovering && !gifMissing;
    const artSrc = `/images/categories/${slug}${showGif ? '.gif' : '.png'}`;

    return (
        <Link
            href={href}
            onMouseDown={() => setBouncing(true)}
            onAnimationEnd={() => setBouncing(false)}
            onMouseEnter={() => setIsHovering(true)}
            onMouseLeave={() => setIsHovering(false)}
            className={`group block p-3 shadow-md transition-transform duration-150 ease-out hover:-rotate-1 hover:scale-105 hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-mauve ${bouncing ? 'animate-card-bounce' : ''}`}
            style={{ backgroundColor: surfaceColor, clipPath: pixelClip(NOTCH) }}
        >
            <div className="relative mb-2 text-center">
                <span
                    aria-hidden="true"
                    className="absolute inset-0 translate-x-[3px] translate-y-[3px] font-pixel text-xl text-black/40 sm:text-2xl"
                >
                    {title}
                </span>
                <span className="relative font-pixel text-xl leading-relaxed text-blush transition-colors duration-150 group-hover:text-yellow-200 sm:text-2xl">
                    {title}
                </span>
            </div>

            <div
                className="flex aspect-[4/3] items-center justify-center bg-blush/90 text-5xl sm:text-6xl"
                style={{ clipPath: pixelClip(ART_NOTCH) }}
            >
                {artMissing ? (
                    icon
                ) : (
                    <img
                        src={artSrc}
                        alt=""
                        onError={() => (showGif ? setGifMissing(true) : setArtMissing(true))}
                        className="h-3/4 w-3/4 object-contain"
                        style={{ imageRendering: 'pixelated' }}
                    />
                )}
            </div>
        </Link>
    );
}
