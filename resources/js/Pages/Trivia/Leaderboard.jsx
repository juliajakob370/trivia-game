import React from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link } from '@inertiajs/react';

export default function Leaderboard({ leaderboard }) {
    return (
        <AuthenticatedLayout
            header={
                <h2 className="font-pixel text-sm text-plum-dark sm:text-base">
                    Leaderboard
                </h2>
            }
        >
            <Head title="Leaderboard" />

            <div className="mx-auto max-w-4xl px-4 py-10 sm:px-6 lg:px-8">
                <div className="overflow-hidden rounded-lg border-4 border-plum-dark bg-blush p-6 shadow-md">
                    <div className="mb-6 flex items-center justify-between">
                        <h3 className="font-pixel text-lg text-plum-dark">
                            Top Players
                        </h3>
                        <Link
                            href={route('dashboard')}
                            className="rounded-md border-2 border-plum-dark bg-rose px-5 py-2 font-retro text-lg text-plum-dark transition hover:bg-rose-dark"
                        >
                            Play Again 🔄
                        </Link>
                    </div>

                    <div className="overflow-x-auto">
                        <table className="w-full border-collapse text-left">
                            <thead>
                                <tr className="border-b-2 border-rose bg-rose-light font-retro text-sm uppercase tracking-wider text-mauve">
                                    <th className="p-3">Rank</th>
                                    <th className="p-3">Player</th>
                                    <th className="p-3">Total Score</th>
                                    <th className="p-3">Avg. Time</th>
                                </tr>
                            </thead>
                            <tbody className="divide-y divide-rose font-retro text-lg text-plum-dark">
                                {leaderboard && leaderboard.length > 0 ? (
                                    leaderboard.map((entry, index) => {
                                        const isTopThree = index < 3;
                                        const rankBadges = ['🥇', '🥈', '🥉'];

                                        return (
                                            <tr
                                                key={entry.id}
                                                className="transition hover:bg-rose-light"
                                            >
                                                <td className="p-3 font-pixel text-xs">
                                                    {isTopThree
                                                        ? rankBadges[index]
                                                        : `#${index + 1}`}
                                                </td>
                                                <td className="p-3">
                                                    {entry.name}
                                                </td>
                                                <td className="p-3 font-bold text-plum">
                                                    {entry.total_score} pts
                                                </td>
                                                <td className="p-3 text-mauve">
                                                    {Number(
                                                        entry.average_time_seconds,
                                                    ).toFixed(1)}
                                                    s
                                                </td>
                                            </tr>
                                        );
                                    })
                                ) : (
                                    <tr>
                                        <td
                                            colSpan="4"
                                            className="p-6 text-center text-mauve"
                                        >
                                            No scores recorded yet. Be the
                                            first to play!
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
