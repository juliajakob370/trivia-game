# Speed-round timer: answering locks in immediately, doesn't wait out the clock

Each question in a Game has a ~10s timer, but selecting an answer locks it in and advances to the next question immediately rather than always waiting out the full 10 seconds regardless of when the player answered.

This matters because the Leaderboard's tie-break is average time per Game. Fixed pacing (always consuming the full window per question) would make every Game converge on roughly the same total time, making that tie-break meaningless. Immediate-lock preserves real reaction-time variance, so the tie-break actually differentiates players.
