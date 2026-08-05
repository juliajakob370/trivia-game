# Category gets its own table instead of a free-text column

`category` was a free-text string on `questions`, defaulting to `'General'`, with no validation. Home needs a fixed-ish but growing grid of Category cards to render. We're promoting Category to its own table, FK'd from `questions`, instead of keeping it a string or moving to a hardcoded array shared between backend and frontend. A real table gives Category a stable identity, avoids typo/casing bugs from string matching, and gives the grid a single source of truth as more categories get added later.
