import React, { useState, useEffect, useRef } from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm } from '@inertiajs/react';

const SECONDS_PER_QUESTION = 20;

export default function Play({ questions, category }) {
    const [currentIndex, setCurrentIndex] = useState(0);
    const [secondsRemaining, setSecondsRemaining] = useState(SECONDS_PER_QUESTION);
    const advancedRef = useRef(false);
    const { data, setData, post, processing, transform, errors } = useForm({
        answers: {},
        time_taken: 0,
    });

    const currentQuestion = questions[currentIndex];
    const isLastQuestion = currentIndex === questions.length - 1;

    useEffect(() => {
        advancedRef.current = false;
    }, [currentIndex]);

    useEffect(() => {
        if (processing) return;

        if (secondsRemaining <= 0) {
            advance(null);
            return;
        }

        const timer = setTimeout(() => {
            setSecondsRemaining((prev) => prev - 1);
        }, 1000);

        return () => clearTimeout(timer);
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [secondsRemaining, processing]);

    const advance = (selectedOption) => {
        if (advancedRef.current) return;
        advancedRef.current = true;

        const timeSpent = SECONDS_PER_QUESTION - secondsRemaining;
        const questionId = currentQuestion.id;

        if (isLastQuestion) {
            transform((current) => ({
                answers: { ...current.answers, [questionId]: selectedOption },
                time_taken: current.time_taken + timeSpent,
            }));
            post(route('trivia.submit'));
        } else {
            setData('answers', { ...data.answers, [questionId]: selectedOption });
            setData('time_taken', data.time_taken + timeSpent);
            setCurrentIndex((prev) => prev + 1);
            setSecondsRemaining(SECONDS_PER_QUESTION);
        }
    };

    return (
        <AuthenticatedLayout
            header={
                <div className="flex items-center justify-between">
                    <h2 className="font-pixel text-sm text-plum-dark sm:text-base">
                        {category}
                    </h2>
                    <span className="font-retro text-lg text-mauve">
                        Question {currentIndex + 1} of {questions.length}
                    </span>
                </div>
            }
        >
            <Head title={`Playing ${category}`} />

            <div className="mx-auto max-w-3xl px-4 py-10 sm:px-6 lg:px-8">
                <div className="overflow-hidden rounded-lg border-4 border-plum-dark bg-blush p-6 shadow-md">
                    {/* Timer */}
                    <div className="mb-6 flex justify-center">
                        <span
                            className={`font-pixel text-3xl ${
                                secondsRemaining <= 3
                                    ? 'animate-pulse text-red-600'
                                    : 'text-plum-dark'
                            }`}
                        >
                            {secondsRemaining}s
                        </span>
                    </div>

                    {/* Question Text */}
                    <h3 className="mb-6 text-center font-retro text-2xl text-plum-dark sm:text-3xl">
                        {currentQuestion?.question_text}
                    </h3>

                    {/* Options Grid */}
                    <div className="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        {['A', 'B', 'C', 'D'].map((letter) => {
                            const optionValue =
                                currentQuestion[`option_${letter.toLowerCase()}`];

                            return (
                                <button
                                    key={`${currentQuestion.id}-${letter}`}
                                    onClick={() => advance(letter)}
                                    disabled={processing}
                                    className="rounded-lg border-2 border-mauve bg-rose-light p-4 text-left font-retro text-lg text-plum-dark transition hover:border-plum hover:bg-rose disabled:opacity-50"
                                >
                                    <span className="mr-2 font-pixel text-xs text-plum">
                                        {letter}
                                    </span>
                                    {optionValue}
                                </button>
                            );
                        })}
                    </div>

                    {errors.answers && (
                        <p className="mt-4 font-retro text-lg text-red-600">
                            {errors.answers}
                        </p>
                    )}
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
