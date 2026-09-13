# Product Design

## Brand direction

- Use a deep navy-to-blue gradient with cyan, violet, and teal accents.
- The visual mark is a speech bubble shaped around a globe, completed by a cyan AI spark. It should communicate translation coverage without relying on text.
- Keep listing assets simple, nonverbal, and high-contrast so they remain legible at WordPress.org's small icon sizes.
- Lead listing copy and banners with the exact sentence: "Fill in missing plugin and theme translations with AI."
- Pair the core promise with a restrained "Free • High-quality" proof point; avoid inflated quality claims.

## Asset source

- `wordpress-org-assets/` contains the assets synchronized to the WordPress.org SVN `assets/` directory by the release workflow.
- Keep icons at 128px and 256px square, banners at 772×250 and 1544×500, and screenshots below 1568px on their longest side.

## Principles

- Keep the translation-status page operational and calm; service health and delivered language-pack value remain the primary content.
- Use native WordPress admin components, typography, spacing, notices, tables, and buttons.
- Make external actions explicit and voluntary. Never transmit site data merely because the status page loads.
- Present sponsorship as optional project support, not as a restriction on existing free functionality.
- State prices and commercial boundaries plainly without countdowns, artificial scarcity, or disruptive notices.

## Sponsored coverage card

The sponsored-coverage card appears after locale coverage and before the explanatory and privacy sections. This placement connects unmet locale needs to an optional action without displacing service status or translation progress.

The card contains:

- a concise explanation that existing community packs remain free;
- three anchor prices for community, launch, and maintained coverage;
- one primary request action and one secondary general-sponsorship action;
- a disclosure that GitHub opens only after a click and that public requests must not contain secrets.

Both links open in a new tab with `noopener noreferrer`. The card uses existing WordPress `.card`, `.button`, and `.button-primary` styles and therefore requires no new visual dependency or custom interaction.
