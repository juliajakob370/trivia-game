import { Link } from '@inertiajs/react';

export default function ResponsiveNavLink({
    active = false,
    className = '',
    children,
    ...props
}) {
    return (
        <Link
            {...props}
            className={`flex w-full items-start border-l-4 py-2 pe-4 ps-3 ${
                active
                    ? 'border-plum bg-rose-light text-plum-dark focus:border-plum-dark focus:bg-rose focus:text-plum-dark'
                    : 'border-transparent text-mauve hover:border-rose-dark hover:bg-rose-light hover:text-plum focus:border-rose-dark focus:bg-rose-light focus:text-plum'
            } text-base font-medium transition duration-150 ease-in-out focus:outline-none ${className}`}
        >
            {children}
        </Link>
    );
}
