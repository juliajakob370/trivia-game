# Home keeps the `dashboard` route name and URL

Home (the Category-picker landing page) replaces what used to render at the `dashboard` route, and "Dashboard" is now reserved as a concept for a future stats page. We're keeping the Laravel route name and URL as `dashboard` for now — only the UI label and page content change to "Home."

Breeze's post-login, registration, and email-verification flows all redirect via `route('dashboard')` across six controllers plus three tests. Renaming the route would touch all of that scaffolding for a purely cosmetic change. The future Dashboard page will claim its own route name/URL when it's actually built.

Consequence: a player lands on the URL `/dashboard` after logging in even though the UI calls it "Home" — worth knowing before grepping for "dashboard" and assuming it's the stats page.
