# Leaderboard aggregates are computed live, not stored on User

The Leaderboard now ranks by a player's Total Score across every Game they've played, tie-broken by average time per Game — not by individual `game_results` rows like before. We compute both via an aggregate query (`SUM`/`AVG` grouped by user) over `game_results` on every Leaderboard read, rather than maintaining running totals on `User` that get updated after each Game.

Denormalized counters would be faster to read but risk drifting out of sync with the actual game history, and `game_results` needs to stay the source of truth anyway for the future Dashboard stats page, which needs the per-game rows, not just a running total. Current game volume makes live aggregation cheap enough that the read-performance win isn't worth that risk yet.
