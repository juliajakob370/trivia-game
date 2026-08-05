# Trivial

A trivia game where players pick a Category, play a timed Game of questions, and compete on a cumulative Leaderboard.

## Language

**Category**:
A themed grouping of trivia questions a player can choose to play (e.g. Food, Animals, Video Games). Has its own identity — not just a label on a Question.
_Avoid_: Topic, subject

**Mix**:
The wildcard option on Home that draws its questions randomly from across every Category, rather than one. Presented alongside Categories on Home but is not itself a Category.
_Avoid_: Random, All, Shuffle

**Game**:
One played round of trivia questions from a single Category (or Mix), timed and scored as a unit. Produces one Score when finished.
_Avoid_: Round, Quiz, Session (session collides with the auth session — don't use it for this)

**Score**:
The points a player earns in a single Game.
_Avoid_: Points, Total (see Total Score for the cross-game figure)

**Total Score**:
The sum of a player's Score across every Game they've ever played. What the Leaderboard ranks by.
_Avoid_: Points, Cumulative points

**Leaderboard**:
The ranked list of players by Total Score, tie-broken by their average time taken per Game (lower is better). Derived fresh from every player's Games whenever it's viewed — not a stored standing.
_Avoid_: Standings, Rankings

**Home**:
The authenticated landing page: a player's entry point for picking a Category and starting a Game. Not the same thing as the Dashboard.
_Avoid_: Landing page, Category picker

**Dashboard**:
Reserved term for a future page showing a player's stats broken down by Category and over time. Does not exist yet. Home is not the Dashboard, even though it currently sits at the same route.
_Avoid_: calling Home "the Dashboard" — that name is reserved for the stats page
