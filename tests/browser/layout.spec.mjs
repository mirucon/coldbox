import { test, expect } from '@playwright/test';

for (const [path, content, status] of [
  ['/', 'Coldbox fixture', 200],
  ['/coldbox-fixture/', 'Coldbox fixture paragraph.', 200],
  ['/fixture-page/', 'Static page fixture.', 200],
  ['/fixture-wide/', 'Static page fixture.', 200],
  ['/?s=not-a-real-fixture-title', 'No matches found.', 200],
  ['/nonexistent-fixture-page/', '404', 404],
]) {
  test(`layout and content: ${path}`, async ({ page }, testInfo) => {
    const errors = [];
    page.on('pageerror', error => errors.push(error.message));
    const response = await page.goto(path, { waitUntil: 'domcontentloaded' });
    expect(response.status()).toBe(status);
    await expect(page.locator('#main')).toContainText(content);
    await expect(page.locator('#main')).toBeVisible();
    expect(await page.evaluate(() => document.documentElement.scrollWidth - innerWidth)).toBeLessThanOrEqual(2);
    // Retain representative rendered evidence for each CI WordPress/PHP target.
    if (path === '/' || path === '/coldbox-fixture/') {
      await page.screenshot({ path: testInfo.outputPath('layout.png'), fullPage: true });
    }
    expect(errors).toEqual([]);
  });
}
