# Copilot instructions for this WordPress theme

## Project architecture
- This is a plain WordPress theme, not a JS app or build system. The entry points are `functions.php` and the files under `configure/`.
- Theme bootstrap lives in `functions.php`, then delegates to `configure/*.php` for menus, ACF, asset loading, shortcode setup, and admin hooks.
- Page rendering is ACF-driven: `page.php` checks `have_rows('page_modules')` and then includes `templates/render-page-modules.php`.
- `templates/render-page-modules.php` is the switchboard for all flexible-content layouts. Every new page section must be added here as a new `case` and must map to a matching partial under `template-parts/flex/layout-*.php`.
- This theme uses local ACF JSON. `configure/acf.php` saves and loads field groups from `acf-json/`; keep group files there and update the JSON timestamp when fields change so WordPress can sync them.

## Layout and content conventions
- New module pattern: add a `case 'your_layout'` in `templates/render-page-modules.php`, then create `template-parts/flex/layout-your-layout.php` that reads `get_sub_field(...)` values and renders markup.
- Existing modules follow a data-first pattern: small, reusable partials such as `template-parts/flex/layout-intro.php` read ACF fields and render Bootstrap-based markup.
- Keep `page_modules` naming consistent with the ACF field group names and `layout-*` filenames. The switch names usually match the ACF layout slug (`text_1col`, `image_slider`, etc.).
- Reuse existing CSS and typography tokens; do not add a new font family unless explicitly required. Prefer the already loaded Bootstrap + project theme styles from `assets/css/`.

## Styling and assets
- Global styling is split across `assets/css/`: `theme.css` is the main entry, with partials like `constants.css`, `base.css`, `typography.css`, `header.css`, `menu.css`, `footer.css`, `forms.css`, `components.css`, and `pages.css`.
- JavaScript is centralized in `assets/js/main.js`; `menu.js` is an example of a secondary module loaded by the theme.
- `configure/js-css.php` enqueues assets and uses `filemtime()` for cache busting; this is the place to add new CSS/JS files to the theme.
- Keep asset changes in-place; there is no `npm build`, bundler, or transpile step for this project.

## WordPress-specific patterns
- Use WordPress sanitization and escaping helpers (`esc_html`, `esc_url`, `wp_kses_post`, `get_template_directory_uri()`, etc.) when outputting data.
- Custom theme setup and cleanup live in `configure/configure.php`; this is the right place for feature flags, image sizes, SVG support, and theme default behavior.
- ACF field JSON files are the source of truth for admin fields; avoid manual field creation in the database when local JSON is active.

## Workflow
- For PHP syntax issues, run `php -l <file.php>` in the theme folder.
- For CSS/JS changes, refresh the WordPress page after saving; this project is not a compiled frontend app.
- When debugging layout issues, inspect the ACF layout name in the render switch and the matching `template-parts/flex/` file before changing CSS.
- If a new section is required, update `page_modules` + `render-page-modules.php` + the new layout partial + the corresponding ACF JSON, then verify the front-end output in WordPress.
