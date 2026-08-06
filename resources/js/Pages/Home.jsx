import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import CategoryCard from '@/Components/CategoryCard';
import { Head } from '@inertiajs/react';

const MIX_SLUG = 'mix';
const MIX_ACCENT_COLOR = '#D9A441';

export default function Home({ categories }) {
    return (
        <AuthenticatedLayout>
            <Head title="Home" />

            <div className="mx-auto max-w-5xl px-4 py-10 sm:px-6 lg:px-8">
                <h1 className="mb-10 text-center font-pixel text-3xl leading-relaxed text-plum-dark sm:text-5xl">
                    Trivial
                </h1>

                <div className="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <CategoryCard
                        title="Mix"
                        slug={MIX_SLUG}
                        icon="🔀"
                        accentColor={MIX_ACCENT_COLOR}
                        highlightColor={MIX_ACCENT_COLOR}
                        href={route('trivia.play', MIX_SLUG)}
                    />

                    {categories.map((category) => (
                        <CategoryCard
                            key={category.id}
                            title={category.name}
                            slug={category.slug}
                            icon={category.icon}
                            accentColor={category.accent_color}
                            href={route('trivia.play', category.slug)}
                        />
                    ))}
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
