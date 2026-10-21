# Working on Coldbox

See [MAINTENANCE.md](MAINTENANCE.md) for the supported scope and build/test commands.
Keep changes focused on observable behavior. Follow the surrounding PHP/JS/CSS
style, preserve existing translation keys where meaning is unchanged, and avoid
unnecessary changes to customization hooks, class names and loading order.

Build the installable package, run native WordPress/PHPUnit tests, and run the
relevant browser checks before proposing a behavior change. Do not publish a
release or update the dist branch as part of an ordinary source change.
