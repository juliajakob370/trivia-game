import { Link } from '@inertiajs/react';

export default function NavLink({
    active = false,
    className = '',
    children,
    ...props
}) {
    return (
        <Link
            {...props}
            className={
                'inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none ' +
                (active
                    ? 'border-plum text-plum-dark focus:border-plum-dark'
                    : 'border-transparent text-mauve hover:border-rose-dark hover:text-plum focus:border-rose-dark focus:text-plum') +
                className
            }
        >
            {children}
        </Link>
    );
}
