import React from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link } from '@inertiajs/react';

export default function Results({ score, maxScore, timeTaken }) {
    return (
        <AuthenticatedLayout
            header={
                <h2 className="font-pixel text-sm text-plum-dark sm:text-base">
                    Game Over
                </h2>
            }
        >
            <Head title="Results" />

            <div className="mx-auto max-w-2xl px-4 py-10 sm:px-6 lg:px-8">
                <div className="rounded-lg border-4 border-plum-dark bg-blush p-8 text-center shadow-md">
                    <p className="mb-2 font-retro text-2xl text-mauve">
                        You scored
                    </p>
                    <p className="mb-6 font-pixel text-4xl text-plum-dark sm:text-5xl">
                        {score} / {maxScore}
                    </p>
                    <p className="mb-8 font-retro text-xl text-mauve">
                        Total time: {timeTaken}s
                    </p>

                    <div className="flex flex-col justify-center gap-4 sm:flex-row">
                        <Link
                            href={route('dashboard')}
                            className="rounded-md border-2 border-plum-dark bg-rose-light px-6 py-3 font-retro text-lg text-plum-dark transition hover:bg-rose"
                        >
                            Back to Home
                        </Link>
                        <Link
                            href={route('trivia.leaderboard')}
                            className="rounded-md border-2 border-plum-dark bg-rose px-6 py-3 font-retro text-lg text-plum-dark transition hover:bg-rose-dark"
                        >
                            View Leaderboard
                        </Link>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
