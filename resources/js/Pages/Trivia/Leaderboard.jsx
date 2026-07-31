import React from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Leaderboard({ auth, leaderboard }) {
    const { flash } = usePage().props;

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Global Leaderboard</h2>}
        >
            <Head title="Leaderboard" />

            <div className="py-12">
                <div className="max-w-4xl mx-auto sm:px-6 lg:px-8">

                    {/* Success Flash Banner */}
                    {flash?.success && (
                        <div className="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 font-semibold rounded shadow-sm">
                            🎉 {flash.success}
                        </div>
                    )}

                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                        <div className="flex justify-between items-center mb-6">
                            <h3 className="text-xl font-bold text-gray-900">Top 10 Players</h3>
                            <Link
                                href="/play"
                                className="px-5 py-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 transition"
                            >
                                Play Again 🔄
                            </Link>
                        </div>

                        {/* Leaderboard Table */}
                        <div className="overflow-x-auto">
                            <table className="w-full text-left border-collapse">
                                <thead>
                                <tr className="border-b bg-gray-50 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    <th className="p-3">Rank</th>
                                    <th className="p-3">Player</th>
                                    <th className="p-3">Score</th>
                                    <th className="p-3">Time</th>
                                    <th className="p-3">Date</th>
                                </tr>
                                </thead>
                                <tbody className="divide-y divide-gray-100 text-sm text-gray-700">
                                {leaderboard && leaderboard.length > 0 ? (
                                    leaderboard.map((item, index) => {
                                        const isTopThree = index < 3;
                                        const rankBadges = ['🥇', '🥈', '🥉'];

                                        return (
                                            <tr key={item.id} className="hover:bg-gray-50 transition">
                                                <td className="p-3 font-bold">
                                                    {isTopThree ? rankBadges[index] : `#${index + 1}`}
                                                </td>
                                                <td className="p-3 font-semibold text-gray-900">
                                                    {item.user ? item.user.name : 'Unknown Player'}
                                                </td>
                                                <td className="p-3 font-bold text-indigo-600">
                                                    {item.score} pts
                                                </td>
                                                <td className="p-3 text-gray-500">
                                                    {item.time_taken_seconds}s
                                                </td>
                                                <td className="p-3 text-gray-400 text-xs">
                                                    {new Date(item.created_at).toLocaleDateString()}
                                                </td>
                                            </tr>
                                        );
                                    })
                                ) : (
                                    <tr>
                                        <td colSpan="5" className="p-6 text-center text-gray-500">
                                            No scores recorded yet. Be the first to play!
                                        </td>
                                    </tr>
                                )}
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
