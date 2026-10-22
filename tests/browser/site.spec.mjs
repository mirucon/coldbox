import { test, expect } from '@playwright/test';

test('article, icons, anchors and text stay usable', async ({ page }) => {
  const errors = [];
  page.on('pageerror', error => errors.push(error.message));
  const assets = [];
  page.on('response', response => { if (response.url().includes('/themes/coldbox/') && response.status() >= 400) assets.push(response.url()); });
  await page.goto('/coldbox-fixture/');
  await expect(page.locator('.entry')).toContainText('Coldbox fixture paragraph');
  await expect(page.locator('html')).toHaveAttribute('lang', /.+/);
  await expect(page.locator('pre')).toHaveClass(/hljs/);
  await expect(page.locator('pre .hljs-keyword')).toHaveText('const');
  await page.getByText('Jump to section', { exact: true }).click();
  await page.getByText('Missing anchor', { exact: true }).click();
  // Literal post-title text must never become executable HTML in the widget.
  await expect(page.locator('.widget_recent_entries img')).toHaveCount(0);
  await expect(page.locator('.widget_recent_entries')).toContainText('Literal <img src=x onerror=alert(1)> title');
  await expect(page.locator('link[rel="amphtml"]')).toHaveCount(0);
  if (await page.locator('#sns-buttons').count()) {
    await expect(page.locator('#sns-buttons .pocket')).toHaveCount(0);
    for (const name of ['feedly', 'hatenabookmark']) {
      const icon = page.locator(`#sns-buttons .si-${name}`);
      await expect(icon).toBeVisible();
      const size = await icon.evaluate(el => {
        const style = getComputedStyle(el, '::before');
        return { width: parseFloat(style.width), height: parseFloat(style.height), font: parseFloat(style.fontSize), mask: style.maskImage };
      });
      expect(size.mask).not.toBe('none');
      expect(size.width).toBeCloseTo(size.font, 1);
      expect(size.height).toBeCloseTo(size.font, 1);
    }
  }
  expect(assets).toEqual([]);
  expect(errors).toEqual([]);
});

test('search opens, closes, and finds the article', async ({ page }) => {
  await page.goto('/');
  await page.locator('.header-inner .search-toggle').click();
  await expect(page.locator('body')).toHaveClass(/modal-search-open/);
  await page.locator('.modal-search-form .close-toggle').click();
  await expect(page.locator('body')).not.toHaveClass(/modal-search-open/);
  await page.locator('.header-inner .search-toggle').click();
  await page.locator('.modal-search-form input[type="search"]').fill('Coldbox fixture');
  await page.locator('.modal-search-form input[type="search"]').press('Enter');
  await expect(page.locator('#main')).toContainText('Coldbox fixture');
  expect(new URL(page.url()).searchParams.get('s')).toBe('Coldbox fixture');
});

test('mobile menu opens and follows an existing link', async ({ page, isMobile }) => {
  test.skip(!isMobile, 'Mobile interaction');
  await page.goto('/');
  await page.locator('#header-nav-toggle').click();
  await expect(page.locator('#header-menu')).toHaveClass(/open/);
  // Closing through the keyboard-accessible button must reset toggle state.
  await page.locator('#close-mobile-menu').focus();
  await page.locator('#close-mobile-menu').press('Enter');
  await expect(page.locator('#header-menu')).not.toHaveClass(/open/);
  await page.locator('#header-nav-toggle').click();
  await expect(page.locator('#header-menu')).toHaveClass(/open/);
  await page.locator('#header-menu').getByText('Fixture article').click();
  await expect(page).toHaveURL(/coldbox-fixture/);
});

test('comment tabs accept clicks on their nested icons and counts', async ({ page }) => {
  const errors = [];
  page.on('pageerror', error => errors.push(error.message));
  await page.goto('/coldbox-fixture/');
  await expect(page.locator('#comment-list')).toContainText('Approved threaded reply.');
  await page.locator('a[href="#ping-list"] .count').click();
  await expect(page.locator('#ping-list')).toBeVisible();
  await expect(page.locator('#comment-list')).toBeHidden();
  await page.locator('a[href="#comment-list"] .fas').click();
  await expect(page.locator('#comment-list')).toBeVisible();
  await expect(page.locator('#ping-list')).toBeHidden();
  expect(errors).toEqual([]);
});

test('old AMP links redirect once to the ordinary article', async ({ request }) => {
  const response = await request.get('/coldbox-fixture/?amp=1&utm_source=archive', { maxRedirects: 0 });
  expect(response.status()).toBe(301);
  expect(response.headers().location).toMatch(/\/coldbox-fixture\/\?utm_source=archive$/);
  const target = await request.get(response.headers().location, { maxRedirects: 0 });
  expect(target.status()).toBe(200);
  expect(await target.text()).not.toMatch(/rel="amphtml"|<html[^>]*⚡/);
});

test('WordPress legacy widget preview runs without a theme header', async ({ page }) => {
  const errors = [];
  page.on('pageerror', error => errors.push(error.message));
  await page.goto('/wp-login.php', { waitUntil: 'domcontentloaded' });
  await page.locator('#user_login').fill('coldbox-test');
  await page.locator('#user_pass').fill('coldbox-local-test');
  // Avoid dashboard feeds: continue straight to the real WP widget preview.
  const preview = new URL('/wp-admin/?legacy-widget-preview[id]=recent-posts-2', page.url()).href;
  await page.locator('input[name="redirect_to"]').evaluate((input, value) => { input.value = value; }, preview);
  await page.locator('#wp-submit').click();
  await page.waitForURL(url => url.searchParams.has('legacy-widget-preview[id]'), { waitUntil: 'domcontentloaded' });
  await expect(page.locator('.widget_recent_entries')).toContainText('Recent posts');
  await expect(page.locator('.recent_entries_post-title').first()).toBeVisible();
  await page.setViewportSize({ width: 800, height: 700 });
  expect(errors).toEqual([]);
});
