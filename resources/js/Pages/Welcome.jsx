import { Head, Link } from '@inertiajs/react';

export default function Welcome({ auth, canLogin, canRegister }) {
    return (
        <>
            <Head title="Welcome" />

            <div className="flex min-h-screen flex-col bg-blush">
                <nav className="mx-auto flex w-full max-w-5xl items-center justify-end gap-2 px-6 py-6">
                    {auth.user ? (
                        <Link
                            href={route('dashboard')}
                            className="rounded-md px-4 py-2 text-sm font-semibold text-plum-dark transition hover:text-plum"
                        >
                            Dashboard
                        </Link>
                    ) : (
                        <>
                            {canLogin && (
                                <Link
                                    href={route('login')}
                                    className="rounded-md px-4 py-2 text-sm font-semibold text-plum-dark transition hover:text-plum"
                                >
                                    Log in
                                </Link>
                            )}

                            {canRegister && (
                                <Link
                                    href={route('register')}
                                    className="rounded-md bg-plum-dark px-4 py-2 text-sm font-semibold text-blush transition hover:bg-plum"
                                >
                                    Sign up
                                </Link>
                            )}
                        </>
                    )}
                </nav>

                <main className="flex flex-1 flex-col items-center justify-center px-6 pb-24 text-center">
                    <h1 className="font-pixel text-4xl leading-relaxed text-plum-dark sm:text-6xl">
                        Trivial
                    </h1>

                    <p className="mt-6 max-w-md text-mauve">
                        Pick a category, race the clock, and see how you stack
                        up on the leaderboard.
                    </p>

                    <Link
                        href={
                            auth.user
                                ? route('dashboard')
                                : route('register')
                        }
                        className="mt-10 rounded-md bg-plum-dark px-6 py-3 text-sm font-semibold uppercase tracking-widest text-blush transition hover:bg-plum"
                    >
                        {auth.user ? 'Play now' : 'Get started'}
                    </Link>
                </main>
            </div>
        </>
    );
}
