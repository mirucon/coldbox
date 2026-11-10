import { test, expect } from '@playwright/test';

test.describe.configure({ mode: 'serial' });

test('share links retain their service names and a single new-tab notice', async ({ page }) => {
  await page.goto('/coldbox-fixture/', { waitUntil: 'domcontentloaded' });
  const names = ['Share on Twitter', 'Save to Hatena Bookmark', 'Share on LINE', 'Share on Facebook', 'Subscribe on Feedly'];
  for (const name of names) {
    const link = page.getByRole('link', { name: `${name} (Opens in a new tab)`, exact: true });
    await expect(link).toHaveCount(1);
    await expect(link).toHaveAttribute('target', '_blank');
    await expect(link.locator('.share-icon')).toHaveAttribute('aria-hidden', 'true');
    await expect(link.locator('svg.new-window-notice')).toHaveCount(1);
    await expect(link.locator('svg.new-window-notice')).toHaveAttribute('aria-hidden', 'true');
    await expect(link.locator('svg.new-window-notice')).toHaveAttribute('focusable', 'false');
  }
  const links = page.locator('#sns-buttons .share-inner');
  const bounds = () => links.evaluateAll(es => es.map(e => { const r = e.getBoundingClientRect(); return [r.x, r.y, r.width, r.height]; }));
  const withNotices = await bounds();
  await page.addStyleTag({ content: '.new-window-notice { display: none !important; }' });
  expect(await bounds()).toEqual(withNotices);
});

test('Customizer Show new-tab icons toggle controls both social links and share buttons', async ({ page, browserName }) => {
  test.skip(browserName !== 'chromium', 'Single-engine admin persistence check avoids parallel DB races');
  await page.goto('/wp-login.php', { waitUntil: 'domcontentloaded' });
  await expect(page.locator('#user_login')).toBeFocused();
  await page.locator('#user_login').fill('coldbox-test');
  await page.locator('#user_pass').fill('coldbox-local-test');
  const czrUrl = new URL('/wp-admin/customize.php', page.url()).href;
  await page.locator('input[name="redirect_to"]').evaluate((el, v) => { el.value = v; }, czrUrl);
  await page.locator('#wp-submit').click();
  await page.waitForURL(url => url.pathname.endsWith('/customize.php'), { waitUntil: 'domcontentloaded' });

  await page.locator('#accordion-section-social_links > .accordion-section-title').click();
  const checkbox = page.locator('#_customize-input-social_links_new_tab_icon');
  await expect(checkbox).toBeChecked();

  try {
    await checkbox.uncheck();
    const saveBtn = page.locator('#save');
    await expect(saveBtn).toBeEnabled();
    await Promise.all([
      page.waitForResponse(r => r.url().includes('admin-ajax.php') && r.request().method() === 'POST'),
      saveBtn.click(),
    ]);
    await expect(saveBtn).toHaveValue('Published');

    await page.goto('/coldbox-fixture/', { waitUntil: 'domcontentloaded' });
    await expect(page.locator('.social-links svg.new-window-notice')).toHaveCount(0);
    await expect(page.locator('#sns-buttons svg.new-window-notice')).toHaveCount(0);
    await expect(page.getByRole('link', { name: 'Share on Twitter (Opens in a new tab)', exact: true })).toHaveAttribute('target', '_blank');
    await expect(page.locator('.social-links a.twitter').first()).toHaveAccessibleName('Twitter (Opens in a new tab)');
  } finally {
    await page.goto(czrUrl, { waitUntil: 'domcontentloaded' });
    await page.locator('#accordion-section-social_links > .accordion-section-title').click();
    if (!(await checkbox.isChecked())) {
      await checkbox.check();
      const saveBtn = page.locator('#save');
      await Promise.all([
        page.waitForResponse(r => r.url().includes('admin-ajax.php') && r.request().method() === 'POST'),
        saveBtn.click(),
      ]);
      await expect(saveBtn).toHaveValue('Published');
    }
  }
  await page.goto('/coldbox-fixture/', { waitUntil: 'domcontentloaded' });
  expect(await page.locator('.social-links svg.new-window-notice').count()).toBeGreaterThan(0);
  expect(await page.locator('#sns-buttons svg.new-window-notice').count()).toBe(5);
});
