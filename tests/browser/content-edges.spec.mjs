import { test, expect } from '@playwright/test';

test('file download keeps readable core colors and respects an author color', async ({ page }) => {
  await page.goto('/fixture-edge/');
  const download = page.getByRole('link', { name: 'Download', exact: true });
  await expect(download).toHaveCSS('color', 'rgb(255, 255, 255)');
  await download.hover();
  await expect(download).toHaveCSS('color', 'rgb(255, 255, 255)');
  await download.focus();
  await expect(download).toHaveCSS('color', 'rgb(255, 255, 255)');
  await expect(page.getByRole('link', { name: 'Custom download', exact: true })).toHaveCSS('color', 'rgb(255, 238, 187)');
});

test('overflowing code is reachable and scrollable by keyboard without extra short-code stops', async ({ page }) => {
  await page.goto('/fixture-edge/');
  const code = page.locator('#wide-code');
  await page.getByRole('link', { name: 'Custom download', exact: true }).focus();
  await page.keyboard.press('Tab');
  await expect(code).toBeFocused();
  await page.keyboard.press('ArrowRight');
  await expect.poll(() => code.evaluate(e => e.scrollLeft)).toBeGreaterThan(0);
  await expect(page.locator('#short-code')).not.toHaveAttribute('tabindex');
  await expect(page.locator('#author-tabindex')).toHaveAttribute('tabindex', '-1');
  await code.evaluate(e => e.style.whiteSpace = 'pre-wrap');
  await expect(code).not.toHaveAttribute('tabindex');
});

test('password submit stays inside a 320px viewport and still unlocks content', async ({ page }) => {
  await page.setViewportSize({ width: 320, height: 800 });
  await page.goto('/fixture-protected/');
  const submit = page.locator('.post-password-form input[type=submit]');
  expect(await submit.evaluate(e => e.getBoundingClientRect().right)).toBeLessThanOrEqual(300.5);
  expect(await page.evaluate(() => document.documentElement.scrollWidth)).toBeLessThanOrEqual(320);
  await page.locator('input[type=password]').fill('fixture');
  await submit.click();
  await expect(page.locator('.entry')).toContainText('Protected text');
  await expect(page.locator('.post-password-form')).toHaveCount(0);
});

test('long gallery caption can be entered and scrolled with arrow keys', async ({ page }) => {
  await page.goto('/fixture-edge/');
  const caption = page.locator('.wp-block-gallery figcaption');
  await page.locator('#author-tabindex').focus();
  await page.keyboard.press('Tab');
  await expect(caption).toBeFocused();
  await page.keyboard.press('ArrowDown');
  await expect.poll(() => caption.evaluate(e => e.scrollTop)).toBeGreaterThan(0);
  await page.keyboard.press('ArrowUp');
  await expect.poll(() => caption.evaluate(e => e.scrollTop)).toBe(0);
});

test('untitled article has a nonvisual heading and search regions have distinct names', async ({ page }) => {
  await page.goto('/fixture-untitled/');
  const title = page.getByRole('heading', { level: 1, name: '(no title)', exact: true });
  await expect(title).toHaveCount(1);
  expect(await title.locator('.screen-reader-text').evaluate(e => e.getBoundingClientRect().width)).toBeLessThanOrEqual(1);
  await page.goto('/?s=fixture');
  await expect(page.getByRole('search', { name: 'Content', exact: true })).toHaveCount(1);
  await expect(page.getByRole('search', { name: 'Search', exact: true })).toHaveCount(1);
});
