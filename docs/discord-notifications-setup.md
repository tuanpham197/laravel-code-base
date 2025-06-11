# Discord Notifications Setup Guide

This guide explains how to set up Discord webhook notifications for Rector failures and code quality issues in your GitHub Actions workflows.

## Discord Setup

### 1. Create a Discord Webhook

1. **Open your Discord server**
2. **Go to Server Settings** (click the server name → "Server Settings")
3. **Navigate to Integrations** → **Webhooks**
4. **Click "Create Webhook"**
5. **Configure the webhook**:
   - **Name**: `CI Notifications` (or any name you prefer)
   - **Channel**: Select the channel where you want notifications
   - **Avatar**: Optional - upload a custom icon
6. **Copy the Webhook URL** - you'll need this for GitHub

### 2. Test Your Webhook (Optional)

You can test your webhook using curl:

```bash
curl -H "Content-Type: application/json" \
     -X POST \
     -d '{"content": "🧪 Test notification from CI setup"}' \
     YOUR_WEBHOOK_URL_HERE
```

## GitHub Repository Setup

### 1. Add Discord Webhook as GitHub Secret

1. **Go to your GitHub repository**
2. **Navigate to Settings** → **Secrets and variables** → **Actions**
3. **Click "New repository secret"**
4. **Add the secret**:
   - **Name**: `DISCORD_WEBHOOK`
   - **Secret**: Paste your Discord webhook URL
5. **Click "Add secret"**

### 2. Verify Permissions

Make sure your GitHub Actions have the necessary permissions. The workflows already include:

```yaml
permissions:
  contents: write
  pull-requests: write
```

## Notification Types

### 1. Rector Failure Notifications

**Triggers when:**
- Rector finds code that needs refactoring
- Pull request fails Rector checks
- Scheduled Rector runs find issues

**Example notification:**
```
🚨 Rector Failed 🚨

Repository: your-org/your-repo
Branch: feature/new-feature
Commit: abc123def
Author: john-doe
Workflow: Rector

Message: Rector found code that needs refactoring
Action: Please run `composer rector:fix` locally and commit the changes

View Details: [GitHub Actions Link]
```

### 2. Rector Auto-fix Success

**Triggers when:**
- Rector automatically fixes code on main/develop
- Changes are committed successfully

**Example notification:**
```
✅ Rector Auto-fix Applied ✅

Repository: your-org/your-repo
Branch: main
Commit: def456ghi
Author: jane-doe

Message: Rector automatically applied code improvements
View Changes: [GitHub Commit Link]
```

### 3. Code Quality Failure

**Triggers when:**
- Any quality check fails (Rector, Pint, PHPStan, Frontend linting)
- Integrated quality workflow encounters errors

**Example notification:**
```
❌ Code Quality Check Failed ❌

Repository: your-org/your-repo
Branch: feature/bugfix
Commit: ghi789jkl
Author: dev-user
Workflow: Code Quality

Failed Checks: One or more of: Rector, Pint, PHPStan, or Frontend linting
Action: Run `composer quality:fix` locally and commit the changes

View Details: [GitHub Actions Link]
```

## Customization Options

### 1. Custom Discord Channels

You can create different webhooks for different types of notifications:

```yaml
# In your workflow files, use different webhook secrets
env:
  DISCORD_WEBHOOK: ${{ secrets.DISCORD_WEBHOOK_CRITICAL }}  # For failures
  # or
  DISCORD_WEBHOOK: ${{ secrets.DISCORD_WEBHOOK_SUCCESS }}   # For successes
```

### 2. Customize Message Format

Edit the notification messages in the workflow files:

```yaml
with:
  args: |
    🔧 **Custom Rector Alert** 🔧
    
    **Project:** ${{ github.repository }}
    **Issues Found:** Refactoring needed
    **Quick Fix:** Run `composer rector:fix`
    
    **Details:** ${{ github.server_url }}/${{ github.repository }}/actions/runs/${{ github.run_id }}
```

### 3. Add Mentions

You can mention specific Discord users or roles:

```yaml
with:
  args: |
    <@USER_ID> or <@&ROLE_ID>
    
    🚨 **Rector Failed** 🚨
    
    Your immediate attention is required!
```

### 4. Rich Embeds (Advanced)

For more sophisticated notifications, you can use Discord embeds:

```yaml
- name: Discord Rich Notification
  uses: sarisia/actions-status-discord@v1
  if: failure()
  with:
    webhook: ${{ secrets.DISCORD_WEBHOOK }}
    status: failure
    title: "Rector Process Failed"
    description: "Code refactoring required"
    color: 0xff0000
    username: "CI Bot"
    avatar_url: "https://github.com/rectorphp/rector/raw/main/assets/rector-logo.png"
```

## Troubleshooting

### Common Issues

1. **Webhook URL Invalid**
   ```
   Error: Invalid webhook URL
   ```
   - Verify the webhook URL is correct
   - Make sure the Discord webhook still exists
   - Check if the secret name matches exactly: `DISCORD_WEBHOOK`

2. **Permission Denied**
   ```
   Error: 403 Forbidden
   ```
   - Ensure the webhook has permission to post in the channel
   - Verify Discord server permissions

3. **Message Too Long**
   ```
   Error: Payload too large
   ```
   - Discord has a 2000 character limit per message
   - Shorten your notification message

### Testing Notifications

Create a test workflow to verify your setup:

```yaml
name: Test Discord Notification

on:
  workflow_dispatch:

jobs:
  test:
    runs-on: ubuntu-latest
    steps:
      - name: Test Discord Notification
        uses: Ilshidur/action-discord@master
        env:
          DISCORD_WEBHOOK: ${{ secrets.DISCORD_WEBHOOK }}
        with:
          args: |
            🧪 **Test Notification** 🧪
            
            If you see this, Discord notifications are working correctly!
            
            **Repository:** ${{ github.repository }}
            **Triggered by:** ${{ github.actor }}
```

## Security Considerations

### 1. Webhook Security

- **Keep webhook URLs secret** - never commit them to your repository
- **Regenerate webhooks** if they're accidentally exposed
- **Use GitHub secrets** for storing sensitive information

### 2. Message Content

- **Don't include sensitive data** in notifications
- **Be mindful of** what information you share in Discord
- **Consider using private channels** for CI notifications

### 3. Rate Limiting

- **Discord has rate limits** - avoid too frequent notifications
- **GitHub Actions** also has usage limits
- **Consider consolidating** multiple failures into single notifications

## Alternative Discord Actions

If you need more features, consider these alternatives:

### 1. sarisia/actions-status-discord
```yaml
- uses: sarisia/actions-status-discord@v1
  with:
    webhook: ${{ secrets.DISCORD_WEBHOOK }}
    status: ${{ job.status }}
    title: "Rector Check"
    description: "Automated code quality check"
```

### 2. appleboy/discord-action
```yaml
- uses: appleboy/discord-action@v1
  with:
    webhook_id: ${{ secrets.DISCORD_WEBHOOK_ID }}
    webhook_token: ${{ secrets.DISCORD_WEBHOOK_TOKEN }}
    message: "Rector process completed"
```

This setup ensures you'll be immediately notified in Discord whenever Rector finds issues that need attention, helping you maintain high code quality across your team! 