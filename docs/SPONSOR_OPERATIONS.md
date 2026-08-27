# Sponsorship Operations

This runbook keeps sponsored work transparent, repeatable, and separate from payment-card handling.

## Workflow states

| Label | Meaning | Exit condition |
|-------|---------|----------------|
| `sponsor:needs-review` | New public request | Feasibility and rights assessment recorded |
| `sponsor:feasibility` | Technical, commercial, or licensing facts are being confirmed | Written scope accepted or request declined |
| `sponsor:funded` | Accepted scope has cleared its funding condition | Delivery work starts |
| `sponsor:in-progress` | Translation or compatibility work is active | Packages and evidence are ready |
| `sponsor:maintained` | Initial delivery is complete and recurring coverage is active | Renewal, pause, or cancellation |
| `sponsor:paused` | Maintenance cannot continue safely or contractually | Blocker resolved or agreement ends |

Use the standard `status:in-review` project label for implementation PR review. Never use a payment status inferred from a comment or screenshot; only the private billing record authorizes `sponsor:funded`.

## Intake review

1. Confirm the issue contains no secrets or private download links. Redact through repository administration and rotate exposed credentials if necessary.
2. Verify the requester relationship: vendor, agency, user, or contributor.
3. Confirm the requester's GitHub account can receive notifications and use the public issue to arrange a private follow-up channel only after feasibility review.
4. Confirm target type, exact text domain, current version, requested locales, release frequency, and public product page.
5. Establish how source strings can be accessed without redistributing proprietary source code.
6. Record whether the vendor authorizes generated language-pack distribution.
7. Estimate source-string count, language count, initial effort, maintenance frequency, and human-review needs.
8. Post one decision: accepted scope, decision-ready questions, or a concise decline reason.

## Acceptance record

An accepted request must record:

- product and text domain;
- supported version or version range;
- target locales;
- initial and recurring deliverables;
- price, term, and payment condition in the private agreement;
- distribution-rights confirmation;
- review level: automated QA or named human-review scope;
- reporting cadence;
- exclusions and response target.

Do not put invoices, personal details, licence keys, private files, or payment records in the public issue.

## Delivery checklist

- Extract strings from an authorized source.
- Preserve placeholders, HTML, plural forms, and WordPress formatting rules.
- Generate translations for only the accepted locales and version.
- Run package, syntax, placeholder, and empty-translation checks.
- Record material AI or human-review corrections.
- Publish through the existing language-pack delivery path.
- Verify installation through a clean client request.
- Update the public issue with product, version, locales, checks, and delivery date.
- Move the issue to `sponsor:maintained` only after evidence is recorded.

## Release maintenance

For every qualifying upstream release:

1. Confirm the release and source are authentic.
2. Compare the translatable catalogue with the last supported version.
3. Translate new or changed strings; retain unchanged reviewed translations.
4. Repeat automated QA and any contracted human review.
5. Publish and verify the refreshed package.
6. Record delivery time and unresolved issues for the next sponsor report.

## Reporting metrics

- Supported products, versions, and locales.
- New and changed strings processed.
- Packages published and installation checks passed.
- Median time from qualifying release to package availability.
- Failed jobs, retries, and unresolved compatibility blockers.
- Human-review corrections per 1,000 source strings when review is included.

Do not report site identities. Use aggregate installation or request counts only when their collection and disclosure are documented and privacy-safe.

## Pause and close conditions

Pause coverage when payment is overdue, source access disappears, rights are withdrawn, the product becomes unsafe to process, or technical incompatibility prevents reliable delivery. State the non-sensitive reason and next action publicly.

When a term ends, keep already delivered language packs available unless legal or security requirements require removal. Remove the maintenance guarantee and record the last supported version and date.
