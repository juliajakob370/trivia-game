import { Link } from '@inertiajs/react';

export default function CategoryCard({ title, icon, accentColor, href, highlightColor }) {
    const titleTextClassName = highlightColor ? 'text-plum-dark' : 'text-blush';

    return (
        <Link
            href={href}
            style={highlightColor ? { borderColor: highlightColor } : undefined}
            className={`group block overflow-hidden rounded-lg border-4 bg-blush shadow-md transition-transform duration-150 ease-out hover:scale-105 hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-mauve ${highlightColor ? '' : 'border-plum-dark'}`}
        >
            <div
                style={highlightColor ? { backgroundColor: highlightColor } : undefined}
                className={`flex h-12 items-center justify-center px-2 ${highlightColor ? '' : 'bg-plum-dark'}`}
            >
                <span
                    className={`truncate font-pixel text-[10px] sm:text-xs ${titleTextClassName}`}
                >
                    {title}
                </span>
            </div>
            <div
                className="flex aspect-[4/3] items-center justify-center text-5xl sm:text-6xl"
                style={{ backgroundColor: accentColor }}
            >
                {icon}
            </div>
        </Link>
    );
}
