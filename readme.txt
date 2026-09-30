=== WPMazic SEO Lite ===
Contributors: wpmazic
Tags: seo, sitemap, schema, open graph, redirects, 404 monitor, breadcrumbs, xml sitemap, meta tags, yoast alternative, rank math alternative
Requires at least: 5.8
Tested up to: 7.0.2
Stable tag: 1.0.1
Requires PHP: 7.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A complete SEO toolkit for WordPress — meta tags, XML sitemaps, schema markup, redirect manager, 404 monitoring, breadcrumbs, and 1-click migration from Yoast, Rank Math, and 9 other plugins.

== Description ==

WPMazic SEO Lite gives you everything you need to optimize your WordPress site for search engines — without the bloat. From meta tags and XML sitemaps to schema markup and redirect management, this plugin handles the technical SEO heavy lifting so you can focus on creating great content.

**Why hundreds of site owners are switching to WPMazic SEO:**

= 🚀 Everything you need, nothing you don't =
Unlike bulky SEO plugins that slow down your admin, WPMazic SEO Lite is built for performance. Clean code, efficient database queries, and zero external requests mean your site stays fast.

= 🔄 1-Click Migration from 10+ Plugins =
Switching from Yoast, Rank Math, AIOSEO, SEOPress, or any of 9 other SEO plugins? The built-in migration wizard imports your titles, descriptions, keywords, OG tags, robots settings, and image metadata automatically — zero manual work.

= 📊 Real-Time SEO Score =
Write better content with live feedback. The SEO Content Score evaluates your title length, meta description, focus keyword usage, and content length — right inside the post editor. No need to switch tabs or use external tools.

= 🛡️ Security built in =
Protect your site from bad bots, hide WordPress version from attackers, disable XML-RPC, block author enumeration, and enforce security headers — all from one settings panel.

= 📈 Smart internal linking =
Build site authority automatically with our auto internal linking engine. Define keyword-to-URL rules, and the plugin intelligently inserts contextual links into your content. No manual linking tedium.

= 📋 Enterprise-ready features =
- XML sitemap with image sitemap support and post-type filtering
- JSON-LD Schema markup (Article, Product, FAQ, LocalBusiness, BreadcrumbList, and more)
- Redirect manager with 301 redirects and automatic slug-change redirects
- 404 Monitor with detailed referrer and user-agent logging
- Breadcrumbs with customizable separator and labels
- IndexNow support for instant search engine notification
- robots.txt and llms.txt editors
- Open Graph / Twitter Cards with dynamic OG image fallback
- Bulk editor for updating SEO meta across dozens of posts at once
- Migration wizard supporting 10+ source plugins


**Complete Feature Overview**

📄 **Meta & Social**
  - SEO title, meta description, focus keyword per post/page/CPT
  - Open Graph (og:) and Twitter Card tags
  - Dynamic OG image fallback (auto-generated SVG)
  - Canonical URLs, robots meta directives
  - RSS feed SEO enhancements

🗺️ **Sitemaps & Indexing**
  - XML sitemap at `/sitemap.xml` with post-type/taxonomy filtering
  - Image sitemap at `/image-sitemap.xml`
  - IndexNow API key + auto-ping on post publish
  - Search engine ping (Google + Bing) on new posts
  - robots.txt editor
  - llms.txt for AI crawler guidance

🔗 **Navigation & Links**
  - Breadcrumbs with flexible shortcode `[wpmazic_breadcrumbs]`
  - Auto internal linking engine (keyword → URL rules)
  - Internal link tracking and analysis
  - Automatic 301 redirect on slug changes

🔀 **Redirections & Monitoring**
  - Full redirect manager with 301 redirects
  - 404 Monitor with hit counts, referrer, and last-hit timestamps
  - Clear log and per-entry deletion

🏢 **Schema & Structured Data**
  - JSON-LD Schema for Article, WebPage, Product, FAQ, LocalBusiness, Organization, Website, BreadcrumbList, VideoObject, JobPosting, Course
  - Local Business schema with address, phone, hours, coordinates
  - Author schema with sameAs profiles

🛡️ **Security**
  - Bad bot blocker (customizable signature list)
  - Security headers (X-Frame-Options, X-Content-Type-Options, Referrer-Policy)
  - XML-RPC disable
  - Hide WordPress version
  - Block author enumeration

📝 **Content & Engagement**
  - SEO Content Score (real-time 0–100 in post editor)
  - Estimated reading time badge on single posts
  - Author bio box with avatar
  - HTML sitemap shortcode `[wpmazic_html_sitemap]`

⚙️ **Tools & Migration**
  - 1-click migration from Yoast, Rank Math, AIOSEO, SEOPress, The SEO Framework, Slim SEO, Squirrly, WP Meta SEO, SmartCrawl, Premium SEO Pack
  - Bulk editor for mass meta updates
  - SEO analysis dashboard with coverage charts
  - Webmaster verification (Google, Bing, Yandex, Baidu)
  - GA4 measurement ID integration


**Why Choose WPMazic SEO Lite?**

→ **Performance-first** — Minimal footprint. No external API calls. No tracking. Your data stays on your server.

→ **Complete toolkit** — Meta tags, schema, sitemaps, redirects, 404 monitoring, breadcrumbs, security — all in one plugin.

→ **Zero lock-in** — All data stored in standard WordPress post meta. You own it. Uninstall anytime.

→ **Migration-ready** — Import from 10+ SEO plugins instantly. No SEO data loss when switching.

→ **Modern codebase** — Follows WordPress coding standards. Properly escaped, sanitized, and nonced. Built with security in mind.

→ **Multisite compatible** — Each site in your network gets independent SEO settings.


= What about bloat? =

We keep it lean. The plugin prioritizes the features that actually impact search rankings — no cryptocurrency widgets, no page builders, no AI image generators. Just SEO.

= Who is this for? =

Freelancers, agencies, store owners, bloggers, and developers who want a fast, modern, and complete SEO plugin without the $69/year price tag.

== Installation ==

1. Upload `wpmazic-seo-lite` to `/wp-content/plugins/` via WordPress admin or FTP
2. Activate from the Plugins screen in WordPress
3. If you are switching from another SEO plugin, the Migration Wizard will appear automatically
4. Visit **WPMazic SEO → Settings** to customize title templates, enable features, and configure security

== Frequently Asked Questions ==

= Can I migrate from Yoast / Rank Math / AIOSEO? =

Absolutely. WPMazic SEO Lite includes a dedicated migration wizard that imports SEO titles, meta descriptions, focus keywords, canonical URLs, robots directives, Open Graph tags, Twitter metadata, and image SEO fields. It supports **Yoast SEO, Rank Math, AIOSEO, SEOPress, The SEO Framework, Slim SEO, Squirrly SEO, WP Meta SEO, SmartCrawl, and Premium SEO Pack** — all in one click.

= Does the XML sitemap replace my existing one? =

Yes. WPMazic SEO Lite generates a complete XML sitemap at `/sitemap.xml` with automatic post-type and taxonomy filtering. It intelligently disables WordPress core sitemaps to avoid duplicate entries. An image-specific sitemap is available at `/image-sitemap.xml`.

= Will I lose my SEO data if I uninstall? =

Your SEO metadata is stored as standard WordPress post meta fields. If you ever decide to switch plugins — or upgrade to WPMazic SEO Pro — your titles, descriptions, and keywords remain in the database. The uninstaller optionally cleans up all plugin-specific data if you choose.

= Is there a limit on redirects or 404 entries? =

No artificial limits. Both the redirect manager and 404 monitor store data in your own WordPress database. You control the data, including clearing logs and deleting individual entries.

= Does this slow down my site? =

No. The plugin is optimized for minimal overhead. Database queries use indexed tables, schema output is cached, and admin assets are loaded only on WPMazic SEO admin pages. No external fonts, no analytics pings, no remote scripts.

= Does it work with page builders? =

Yes. WPMazic SEO Lite operates at the WordPress core level and is fully compatible with Elementor, Divi, WPBakery, Beaver Builder, Oxygen, Bricks, Breakdance, Gutenberg, and all major page builders.

= Is the plugin multisite-compatible? =

Yes. Fully compatible with WordPress multisite networks. Each subsite has independent SEO settings, sitemaps, and meta configurations.

= Do I need an account or API key? =

No. All features work immediately after installation. No account registration, no license key, no tracking — just install and configure.

= How do I get started? =

1. Install and activate the plugin
2. If you have an existing SEO plugin, the Migration Wizard will offer to import your data
3. Visit **WPMazic SEO → Settings** to fine-tune feature toggles and title templates
4. Review your XML sitemap at `/sitemap.xml`
5. Add the breadcrumbs shortcode `[wpmazic_breadcrumbs]` to your theme

= How does the 404 Monitor help? =

It automatically logs every 404 request with the referring URL, hit count, and last access time. This helps you identify broken internal links, outdated inbound backlinks, and crawl waste — then create redirects to preserve link equity.

= What Schema types are supported? =

Article, WebPage, Product, FAQ (with structured Q&A items), LocalBusiness, Organization, Website, BreadcrumbList, VideoObject, JobPosting, Course, and Author with sameAs profiles. All output as JSON-LD in the page `<head>`.

= Can I control which post types appear in the sitemap? =

Yes. The sitemap settings include include/exclude filters for post types and taxonomies. You can also enable or disable the image sitemap independently.

= Does this work with WooCommerce? =

Yes. While the Lite version includes general SEO meta for products (title, description, OG tags), the Pro version adds dedicated WooCommerce structured data and a Merchant Listing meta box for enhanced product visibility in search results.

== Screenshots ==

1. Dashboard overview — SEO coverage charts, quick stats, and recommended next actions
2. Settings panel — feature toggles, title templates, and global configuration
3. Tools page — robots.txt and llms.txt editors with live preview
4. Redirect manager — add, track, and manage 301 redirects with hit counters
5. SEO meta box — per-post editor with focus keyword, snippet preview, and schema type selection
6. SEO Content Score — real-time 0–100 analysis in the post editor
7. SEO Analysis dashboard — content optimization suggestions and metadata coverage
8. Bulk Editor — update SEO titles, descriptions, and keywords for multiple posts at once
9. 404 Monitor — tracking table with referrer data, hit counts, and clear log controls
10. Migration Wizard — 4-step guided import from Yoast, Rank Math, AIOSEO, and more
11. Local SEO — business information settings for LocalBusiness schema
12. Pro Features comparison — side-by-side view of Lite vs Pro capabilities

== Support ==

Support is handled through the official WordPress.org plugin forum:
https://wordpress.org/support/plugin/wpmazic-seo-lite/

Before posting, please check the FAQ section above and the plugin's inline help text (hover over question marks in the admin).

== Pro Features ==

WPMazic SEO Pro unlocks additional capabilities for growing sites and agencies:

**Remove Lite limits:**
- **Unlimited Auto Internal Links** — no per-post or per-rule caps
- **Unlimited HTML Sitemap** — includes taxonomy sections
- **Full SEO Content Score** — keyword density, readability metrics, detailed recommendations
- **Search Engine Ping on All Updates** — ping Google/Bing on every post update

**Exclusive Pro tools:**
- **Video Sitemap** — dedicated `video-sitemap.xml` for video content
- **News Sitemap** — Google News–compliant XML sitemap
- **Term SEO** — per-category/per-tag title, description, and OG controls
- **WooCommerce SEO** — product schema + Merchant Listing meta box
- **Hreflang Tags** — language/region alternates for multilingual content
- **URL Controls** — enforce HTTPS, www/non-www, and trailing slash rules
- **SEO Revisions & Rollback** — track changes and restore previous meta values
- **SEO Audit** — automated broken-link scanning
- **Redirect Assistant** — smart redirect suggestions from 404 data
- **AI Assistant, AI Alt Text, AI Bulk Meta** — AI-powered content workflows
- **Rank Tracker** — keyword position monitoring
- **Google Indexing API** — instant URL submission
- **Email Reports** — scheduled SEO performance summaries
- **White Label** — rebrand for client deliverables

See the full comparison at **WPMazic SEO → Pro Features** in your WordPress admin, or visit:
https://wpmazic.com/wpmazic-seo/

== Changelog ==

= 1.0.1 =
* **New:** SEO Content Score — real-time 0–100 analysis in the post editor (title, description, keyword, content length)
* **New:** Auto Internal Links — keyword-to-URL rule engine with automatic link injection (Lite: 3 links/post, 5 rules)
* **New:** HTML Sitemap — shortcode [wpmazic_html_sitemap] for human-readable sitemap pages (Lite: 50 items)
* **New:** Search Engine Ping — auto-ping Google and Bing when new posts are published
* **New:** Blog Enhancements — estimated reading time badge and author bio box on single posts
* **New:** Pro Features comparison page in admin (WPMazic SEO → Pro Features)
* **Fix:** XML sitemap URL no longer conflicts with WordPress core sitemaps
* **Fix:** Image sitemap, Dynamic OG, IndexNow, and llms.txt rewrite rules now resolve correctly
* **Fix:** Front-page schema type changed from Article to WebPage for static front pages
* **Fix:** Migration Wizard 403 access error resolved for admin users
* **Fix:** SQL queries now use $wpdb->prepare() in cache clearing and analysis page
* **Fix:** Frontend blog enhancement styles moved from inline to CSS

= 1.0.0 =
* Initial Lite release
* Free-feature package with setup wizard, migration, and core SEO toolkit

== Upgrade Notice ==

= 1.0.1 =
New features: SEO Content Score, Auto Internal Links, HTML Sitemap, Search Engine Ping, Blog Enhancements. Bug fixes for sitemap conflicts, rewrite rules, schema types, and migration wizard access.

= 1.0.0 =
Initial release. All essential SEO features included for free.
