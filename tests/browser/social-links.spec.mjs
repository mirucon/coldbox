import { test, expect } from '@playwright/test';

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
