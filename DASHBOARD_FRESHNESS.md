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
