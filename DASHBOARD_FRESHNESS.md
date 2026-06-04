# Supervisor Dashboard Freshness

This repository has two aidevops-maintained dashboard issues with different
purposes:

- Issue #8 is the legacy queue health dashboard. It reports supervisor queue
  state and can remain unchanged when the repo has no active PRs, assigned
  issues, auto-dispatch work, or workers.
- Issue #17 is the current code audit routines dashboard. It is updated by the
  daily quality sweep and should be used for code-audit freshness checks.

When a freshness alert references issue #8, verify both surfaces before treating
the scheduler as broken:

```bash
gh issue view 8 --repo Ultimate-Multisite/ultimate-ai-plugin-translations \
  --json title,state,updatedAt,body
gh issue view 17 --repo Ultimate-Multisite/ultimate-ai-plugin-translations \
  --json title,state,updatedAt,body
```

Expected healthy evidence from `~/.aidevops/logs/stats.log` is an hourly
`[stats-wrapper] Finished` entry and a health-refresh line like:

```text
[stats] Health issue: skipping creation for Ultimate-Multisite/ultimate-ai-plugin-translations — no active PRs, assigned issues, auto-dispatch work, or workers
[stats] Health issues: updated 15 repo(s)
```

If issue #8 is stale but the log shows the skip line above and issue #17 has a
recent `Last sweep`, the scheduler is running; the stale queue dashboard is a
legacy/inactive-work signal rather than a plugin code defect.

## Issue #26 triage evidence

Issue #26 was generated from issue #8 after the legacy queue dashboard appeared
stale. The local scheduler evidence showed the stats wrapper was still running:

```text
[stats-wrapper] Finished at 2026-06-04T17:49:19Z
[stats] Health issue: skipping creation for Ultimate-Multisite/ultimate-ai-plugin-translations — no active PRs, assigned issues, auto-dispatch work, or workers
[stats] Health issues: updated 15 repo(s)
```

The dashboard issue also had a fresh body marker during triage:

```text
issue #8 updated_at=2026-06-04T16:15:40Z
has_last_refresh=true
```

Root cause: the freshness alert was based on the legacy queue dashboard's
previous timestamp, while the stats wrapper was healthy and the repo had no
active queue work to report. Treat this as a false-positive stale-dashboard
alert unless `stats.log` lacks recent `[stats-wrapper] Finished` entries or the
issue body no longer contains `last_refresh:`.
