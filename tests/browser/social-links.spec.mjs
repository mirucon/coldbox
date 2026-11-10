import { test, expect } from '@playwright/test';

test.describe.configure({ mode: 'serial' });

test('share links retain their service names, copy action, and a single new-tab notice', async ({ page }) => {
  await page.goto('/coldbox-fixture/', { waitUntil: 'domcontentloaded' });
  const names = ['Share on Twitter', 'Save to Hatena Bookmark', 'Share on LINE', 'Share on Facebook'];
  for (const name of names) {
    const link = page.getByRole('link', { name: `${name} (Opens in a new tab)`, exact: true });
    await expect(link).toHaveCount(1);
    await expect(link).toHaveAttribute('target', '_blank');
    await expect(link.locator('.share-icon')).toHaveAttribute('aria-hidden', 'true');
    await expect(link.locator('svg.new-window-notice')).toHaveCount(1);
    await expect(link.locator('svg.new-window-notice')).toHaveAttribute('aria-hidden', 'true');
    await expect(link.locator('svg.new-window-notice')).toHaveAttribute('focusable', 'false');
  }
  await expect(page.locator('#sns-buttons .feedly')).toHaveCount(0);
  const copyBtn = page.getByRole('button', { name: 'Copy link', exact: true });
  await expect(copyBtn).toHaveCount(1);
  await expect(copyBtn.locator('svg.new-window-notice')).toHaveCount(0);
  const links = page.locator('#sns-buttons .share-inner');
  await expect(links).toHaveCount(5);
  const iconOffsets = await links.evaluateAll(es => es.map(e => {
    const r = e.getBoundingClientRect();
    const ic = e.querySelector('.share-icon').getBoundingClientRect();
    return Math.abs((ic.left + ic.width / 2) - (r.left + r.width / 2));
  }));
  for (const offset of iconOffsets) expect(offset).toBeLessThanOrEqual(0.5);
  const heights = await links.evaluateAll(es => es.map(e => Math.round(e.getBoundingClientRect().height)));
  expect(new Set(heights).size).toBe(1);
  const bounds = () => links.evaluateAll(es => es.map(e => { const r = e.getBoundingClientRect(); return [r.x, r.y, r.width, r.height]; }));
  const withNotices = await bounds();
  await page.addStyleTag({ content: '.new-window-notice { display: none !important; }' });
  expect(await bounds()).toEqual(withNotices);

  await copyBtn.focus();
  const copyTooltip = page.locator('#sns-buttons .copy .cd-tooltip');
  await expect(copyTooltip).toBeVisible();
  await expect(copyTooltip).toHaveText('Copy link');
  await copyBtn.click();
  await expect(copyBtn).toHaveClass(/is-copied/);
  await expect(copyBtn.locator('.share-icon')).toHaveClass(/fa-check/);
  await expect(copyTooltip).toHaveText('Link copied');
  await expect(page.locator('#sns-buttons .js-copy-status')).toHaveText('Link copied');
  await page.keyboard.press('Escape');
  await expect(copyTooltip).toBeHidden();
});

test('Customizer social toggles control new-tab icons and X branding across theme and Add-on', async ({ page, browserName }) => {
  test.skip(browserName !== 'chromium', 'Single-engine admin persistence check avoids parallel DB races');
  test.setTimeout(60000);
  await page.goto('/wp-login.php', { waitUntil: 'domcontentloaded' });
  await expect(page.locator('#user_login')).toBeFocused();
  await page.locator('#user_login').fill('coldbox-test');
  await page.locator('#user_pass').fill('coldbox-local-test');
  const czrUrl = new URL('/wp-admin/customize.php', page.url()).href;
  await page.locator('input[name="redirect_to"]').evaluate((el, v) => { el.value = v; }, czrUrl);
  await page.locator('#wp-submit').click();
  await page.waitForURL(url => url.pathname.endsWith('/customize.php'), { waitUntil: 'domcontentloaded' });

  await page.locator('#accordion-section-sns_buttons > .accordion-section-title').click();
  const addonXCheckbox = page.locator('#_customize-input-sns_twitter_as_x');
  await expect(addonXCheckbox).not.toBeChecked();
  await addonXCheckbox.check();
  await page.locator('#sub-accordion-section-sns_buttons .customize-section-back').click();

  await page.locator('#accordion-section-social_links > .accordion-section-title').click();
  const newTabCheckbox = page.locator('#_customize-input-social_links_new_tab_icon');
  const xCheckbox = page.locator('#_customize-input-social_links_twitter_as_x');
  await expect(newTabCheckbox).toBeChecked();
  // Toggling X in Social Buttons must sync immediately with Social Links.
  await expect(xCheckbox).toBeChecked();
  await newTabCheckbox.uncheck();

  // Save as a Customizer draft changeset via the UI so parallel browser workers on / remain isolated.
  await page.locator('#publish-settings').click();
  await page.getByRole('radio', { name: 'Save Draft' }).check();
  const saveBtn = page.locator('#save');
  await Promise.all([
    page.waitForResponse(r => r.url().includes('admin-ajax.php') && r.request().method() === 'POST'),
    saveBtn.click(),
  ]);
  await expect(saveBtn).toHaveValue('Draft Saved');
  const uuid = await page.evaluate(() => wp.customize.settings.changeset.uuid);

  try {
    await page.goto(`/coldbox-fixture/?customize_changeset_uuid=${encodeURIComponent(uuid)}`, { waitUntil: 'domcontentloaded' });
    await expect(page.locator('.social-links svg.new-window-notice')).toHaveCount(0);
    await expect(page.locator('#sns-buttons svg.new-window-notice')).toHaveCount(0);
    await expect(page.getByRole('link', { name: 'Share on X (Opens in a new tab)', exact: true })).toHaveAttribute('target', '_blank');
    await expect(page.locator('#sns-buttons .x-twitter .share-inner')).toHaveCSS('background-color', 'rgb(34, 38, 42)');
    await expect(page.locator('.social-links a.x-twitter').first()).toHaveAccessibleName('X (Opens in a new tab)');

    await page.goto(`${czrUrl}?changeset_uuid=${encodeURIComponent(uuid)}`, { waitUntil: 'domcontentloaded' });
    await page.locator('#accordion-section-social_links > .accordion-section-title').click();
    await expect(newTabCheckbox).not.toBeChecked();
    await expect(xCheckbox).toBeChecked();
  } finally {
    if (!page.url().includes(`changeset_uuid=${encodeURIComponent(uuid)}`)) {
      await page.goto(`${czrUrl}?changeset_uuid=${encodeURIComponent(uuid)}`, { waitUntil: 'domcontentloaded' });
    }
    await page.locator('#publish-settings').click();
    page.once('dialog', dialog => dialog.accept());
    await page.getByRole('button', { name: 'Discard changes' }).click();
    await page.waitForURL(url => !url.searchParams.has('changeset_uuid'), { waitUntil: 'domcontentloaded' });
  }
});
