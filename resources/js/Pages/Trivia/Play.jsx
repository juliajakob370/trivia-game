import React, { useState, useEffect } from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm } from '@inertiajs/react';

export default function Play({ auth, questions }) {
    const [currentIndex, setCurrentIndex] = useState(0);
    const [secondsRemaining, setSecondsRemaining] = useState(60); // 60s total round timer
    const { data, setData, post, processing, errors, transform } = useForm({
        answers: {},
        time_taken: 0,
    });
    const currentQuestion = questions[currentIndex];
    const isLastQuestion = currentIndex === questions.length - 1;

    // ⏱️ Live Round Timer
    useEffect(() => {
        if (secondsRemaining <= 0) {
            handleSubmit();
            return;
        }

        const timer = setInterval(() => {
            setSecondsRemaining((prev) => prev - 1);
        }, 1000);

        return () => clearInterval(timer);
    }, [secondsRemaining]);

    // Record option choice for current question
    const handleSelectOption = (optionKey) => {
        setData('answers', {
            ...data.answers,
            [currentQuestion.id]: optionKey,
        });
    };

    const handleSubmit = () => {
        if (processing) return;

        transform((data) => ({
            ...data,
            time_taken: 60 - secondsRemaining,
        }));

        post(route('trivia.submit'));
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Trivia Challenge</h2>}
        >
            <Head title="Play Trivia" />

            <div className="py-12">
                <div className="max-w-3xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                        {/* Header: Progress & Timer */}
                        <div className="flex justify-between items-center mb-6 pb-4 border-b">
                            <span className="text-sm font-semibold text-gray-500">
                                Question {currentIndex + 1} of {questions.length}
                            </span>
                            <span className={`text-lg font-bold ${secondsRemaining <= 10 ? 'text-red-600 animate-pulse' : 'text-indigo-600'}`}>
                                ⏱️ {secondsRemaining}s
                            </span>
                        </div>

                        {/* Question Text */}
                        <h3 className="text-xl font-bold text-gray-900 mb-6">
                            {currentQuestion?.question_text}
                        </h3>

                        {/* Options Grid */}
                        <div className="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                            {['A', 'B', 'C', 'D'].map((letter) => {
                                const optionKey = letter;
                                const optionValue = currentQuestion[`option_${letter.toLowerCase()}`];
                                const isSelected = data.answers[currentQuestion.id] === optionKey;

                                return (
                                    <button
                                        key={letter}
                                        onClick={() => handleSelectOption(optionKey)}
                                        className={`p-4 text-left rounded-lg border-2 transition-all font-medium ${
                                            isSelected
                                                ? 'border-indigo-600 bg-indigo-50 text-indigo-900 shadow-sm'
                                                : 'border-gray-200 hover:border-gray-300 text-gray-700'
                                        }`}
                                    >
                                        <span className="font-bold mr-2 text-indigo-500">{letter}.</span> {optionValue}
                                    </button>
                                );
                            })}
                        </div>

                        {/* Navigation Actions */}
                        <div className="flex justify-between items-center pt-4 border-t">
                            <button
                                disabled={currentIndex === 0}
                                onClick={() => setCurrentIndex((prev) => prev - 1)}
                                className="px-4 py-2 border rounded-md text-gray-600 hover:bg-gray-50 disabled:opacity-30"
                            >
                                Previous
                            </button>

                            {isLastQuestion ? (
                                <button
                                    onClick={handleSubmit}
                                    disabled={processing}
                                    className="px-6 py-2 bg-green-600 text-white font-semibold rounded-md hover:bg-green-700 transition"
                                >
                                    {processing ? 'Submitting...' : 'Finish & Submit 🚀'}
                                </button>
                            ) : (
                                <button
                                    onClick={() => setCurrentIndex((prev) => prev + 1)}
                                    className="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 transition"
                                >
                                    Next Question ➡️
                                </button>
                            )}
                        </div>
                        {errors.answers && <p className="text-red-600 text-sm mt-2">{errors.answers}</p>}

                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
