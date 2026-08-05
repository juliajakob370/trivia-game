Status: ready-for-agent

# Home Page Redesign: Category Picker, Speed-Round Games, Cumulative Leaderboard

## Problem Statement

The page a player lands on after logging in is just Laravel Breeze's default placeholder ("You're logged in!") — it gives no way to choose what to play and doesn't reflect the game's identity. Underneath it, games are a fixed 5 generic questions with flat scoring, and the Leaderboard ranks individual game rows rather than rewarding players for playing more over time. There's no visual identity yet either — the app still looks like unstyled Breeze scaffolding.

## Solution

Replace the placeholder Home page with a pixel-inspired, muted rose/mauve/plum category picker: a sticky nav (Home / Leaderboard tabs with an active-tab underline, plus a profile dropdown), a "Trivial" title, and a responsive grid of reusable Category cards (3 per row desktop, scaling down to 1 per row on narrow screens). Clicking a card starts a 10-question speed-round Game from that Category, or a random Mix across all categories. The Leaderboard becomes a live ranking by a player's Total Score summed across every Game they've played, tie-broken by their average time per Game. Play and Leaderboard pages get the same visual treatment as Home.

## User Stories

1. As a player, I want to see a Home page with categories after logging in, so that I can immediately choose what to play instead of a blank placeholder.
2. As a player, I want a sticky nav with Home and Leaderboard tabs, so that I can move between the category picker and the leaderboard without losing my place as I scroll.
3. As a player, I want the tab I'm currently on to be visually underlined, so that I always know where I am in the app.
4. As a player, I want a profile icon in the top-right with a dropdown for Profile and Log Out, so that I can manage my account without cluttering the main nav.
5. As a player, I want to see the "Trivial" title prominently below the nav, so that the app has a clear identity.
6. As a player, I want the category grid built from a reusable card component, so that adding new categories later doesn't require redesigning the layout.
7. As a player, I want 3 category cards per row on desktop, scaling down to 2 and then 1 per row on smaller screens, so that the page is usable on mobile.
8. As a player, I want each category card to show the category name at the top and a themed visual filling the rest of the card, so that I can quickly recognize categories at a glance.
9. As a player, I want a card to zoom in slightly on hover, so that the interface feels responsive and game-like.
10. As a player, I want to choose from Food, Animals, Movies, Computers, Ocean, Music, Space, Sports, Geography, and Video Games, so that I have a variety of trivia topics to play.
11. As a player, I want a "Mix" option that pulls questions from any category, so that I can play a varied game without committing to one topic.
12. As a player, I want the Mix card to look visually distinct from the regular category cards and sit first in the grid, so that I can recognize it as the special "quick play" option.
13. As a player, I want clicking a category card to immediately start a Game of 10 questions from that category, so that I can play without extra setup steps.
14. As a player, when I pick a category with fewer than 10 questions available, I want to play with however many questions exist rather than being blocked, so that thin categories are still playable.
15. As a player, I want each question to have a ~10 second timer, so that games are fast-paced.
16. As a player, I want my answer to lock in and the game to advance immediately when I select an option, so that the game rewards fast thinking and my time-per-question is tracked accurately.
17. As a player, if I don't answer before the timer runs out, I want the question to lock in as unanswered and advance automatically, so that the game keeps moving even if I hesitate.
18. As a player, I want to only move forward through questions with no way to go back, so that my answers and times reflect one honest, uninterrupted attempt.
19. As a player, I want each correct answer worth a flat 10 points (100 max per game), so that scoring stays simple and predictable.
20. As a player, I want my Total Score to be the sum of my Score across every Game I've ever played, so that playing more (and better) improves my standing over time.
21. As a player, I want the Leaderboard to rank by Total Score, tie-broken by average time per Game (faster wins), so that ties are broken by genuine skill/speed rather than luck.
22. As a player, I want the Leaderboard to show the top 10 players, so that I can see how I stack up against the best.
23. As a player, I want the Play and Leaderboard pages to share the same pixel/rose visual theme as Home, so that the whole app feels cohesive instead of switching styles mid-experience.
24. As a returning player, I want to land on the same URL I always have after logging in, so that Breeze's existing login/registration/verification redirects keep working even though the page now shows something different.
25. As a guest (not logged in), I want the existing public welcome page left as-is, so that first impressions before signing up don't change unexpectedly.

## Implementation Decisions

- Introduce a `Category` model and migration (id, name, and whatever fields drive card presentation, e.g. an accent color and a placeholder icon/emoji), seeded with the 10 named categories. Categories are a real table, not a hardcoded list or free-text column — see ADR 0001.
- Replace the `questions.category` free-text string with a `category_id` foreign key to `categories`. Backfill/re-tag existing seeded questions against the new categories.
- Rework starting a Game to accept a category selection: either a specific Category (10 random questions from it, or fewer if that many aren't available) or Mix (10 random questions with no category filter).
- Rebalance scoring from 5 questions × 20 pts to 10 questions × 10 pts — same flat-points model, no time-based bonus.
- Keep writing one result row per Game (user, score, time taken) on submission — no schema change needed there, since the Leaderboard aggregates at read time rather than storing a running total (see ADR 0002).
- Change the Leaderboard query from "top 10 individual game rows ordered by score" to "top 10 users ordered by SUM(score) across all their games, tie-broken by AVG(time_taken) ascending" — a grouped aggregate over the existing per-game results.
- Rework the authenticated nav: tabs become "Home" and "Leaderboard" (replacing the current single "Dashboard" link), with an active-tab underline; nav becomes sticky; the profile dropdown (Profile / Log Out) is retained as-is.
- Replace the page currently rendered at the dashboard route with the new category-grid Home page. Deliberately leave the route's name and URL unchanged so Breeze's login/registration/verification redirects don't need to change — see ADR 0003.
- Introduce a reusable category-card component (name, accent/placeholder art, click handler) used for all 10 categories plus the visually distinct Mix option.
- Rework the Play page's game loop: from a single whole-round countdown with free back/forward navigation, to a per-question countdown where selecting an answer locks it in and advances immediately, and timing out with no selection also locks in and advances — forward-only, no going back. See ADR 0004 for why immediate-lock (not fixed-pacing) was chosen.
- Apply the visual theme (muted rose/mauve/plum palette, pixel-style display font for headings, a more readable retro font for body text) across Home, Play, and Leaderboard.
- Expand placeholder seed data so each of the 10 categories has enough sample questions to fill a game, building on the seeding work already in progress.

## Testing Decisions

- Good tests here assert observable behavior through the real HTTP boundary — status codes, the Inertia page/component name, the props returned, redirects, and resulting DB state — not internal implementation details like which method computed a score.
- Single seam for the whole feature: Laravel Feature tests hitting the actual routes as an authenticated user. Cover: Home's rendered category props, starting a Game for a specific category, the "fewer than 10 questions available" edge case, Mix pulling from all categories, submitting a Game's answers and score calculation, and the Leaderboard's aggregate ranking and tie-break ordering.
- Prior art: `tests/Feature/ProfileTest.php` and `tests/Feature/Auth/*` for the pattern of hitting a route as an authenticated user and asserting on the Inertia response/DB state.
- Visual and interaction polish (hover zoom, responsive breakpoints, palette, pixel fonts, placeholder art) is not covered by automated tests. The user will verify this manually in the browser themselves.

## Out of Scope

- The future Dashboard stats page (per-category / over-time player stats) — not designed, not built here.
- Any change to the public guest-facing welcome page.
- Real pixel art assets — placeholders (accent color blocks + emoji) stand in until the user creates the actual art herself.
- Frontend/JS automated testing — no test runner is currently configured for this repo, and the user will test the frontend manually.
- Renaming the `dashboard` Laravel route/URL — deliberately deferred, see ADR 0003.

## Further Notes

- Domain vocabulary for this feature lives in `CONTEXT.md` (Category, Mix, Game, Score, Total Score, Leaderboard, Home vs Dashboard) — use those terms, not synonyms, during implementation.
- Four ADRs in `docs/adr/` record the non-obvious calls behind this spec: 0001 (Category as a table), 0002 (Leaderboard computed live), 0003 (Home keeps the `dashboard` route), 0004 (speed-round immediate-lock timer).
- Seed data is being extended from an in-progress, currently uncommitted version of `QuestionSeeder.php` — check its current state before adding to it rather than assuming it's empty.
