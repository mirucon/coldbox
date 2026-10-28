import { test, expect } from '@playwright/test';
import axe from 'axe-core';

async function scan(page) {
  // Contrast must be measured after opening fades, not against a transient frame.
  await page.evaluate(() => Promise.all(document.getAnimations()
    .filter(animation => animation.effect.getTiming().iterations !== Infinity)
    .map(animation => animation.finished.catch(() => {}))));
  await page.addScriptTag({ content: axe.source });
  const violations = await page.evaluate(async () => (await axe.run()).violations
    .map(({ id, nodes }) => ({ id, targets: nodes.map(node => node.target) })));
  expect(violations).toEqual([]);
}

for (const path of ['/', '/coldbox-fixture/', '/fixture-page/', '/fixture-wide/', '/category/uncategorized/', '/?s=missing-a11y', '/missing-a11y/']) {
  test(`accessible page and skip link: ${path}`, async ({ page }) => {
    await page.goto(path, { waitUntil: 'domcontentloaded' });
    await scan(page);
    await page.keyboard.press('Tab');
    await expect(page.locator('.skip-link')).toBeFocused();
    const visible = await page.locator('.skip-link').evaluate(el => {
      const rect = el.getBoundingClientRect();
      return rect.width > 20 && rect.height > 10 && rect.top >= 0 && getComputedStyle(el).clip === 'auto';
    });
    expect(visible).toBe(true);
    await page.keyboard.press('Enter');
    await page.keyboard.press('Tab');
    expect(await page.locator(':focus').evaluate(el => !el.closest('#header'))).toBe(true);
  });
}

test('search dialog cycles both ways and restores keyboard focus', async ({ page }) => {
  await page.goto('/');
  const toggle = page.locator('.header-inner .search-toggle');
  const search = page.locator('.modal-search-form input');
  const close = page.locator('.modal-search-form .close-toggle');
  await toggle.focus();
  await page.keyboard.press('Enter');
  await expect(search).toBeFocused();
  await expect(toggle).toHaveAttribute('aria-expanded', 'true');
  await scan(page);
  await page.keyboard.press('Shift+Tab');
  await expect(close).toBeFocused();
  await page.keyboard.press('Tab');
  await expect(search).toBeFocused();
  await page.keyboard.press('Escape');
  await expect(toggle).toBeFocused();
  await expect(toggle).toHaveAttribute('aria-expanded', 'false');
});

test('mobile menu keeps focus in its visible controls and closes with Escape', async ({ page, isMobile }) => {
  test.skip(!isMobile, 'Mobile menu');
  await page.goto('/');
  const toggle = page.locator('#header-nav-toggle');
  await toggle.focus();
  await page.keyboard.press('Space');
  await expect(page.locator('#header-menu a').first()).toBeFocused();
  await expect(toggle).toHaveAttribute('aria-expanded', 'true');
  await scan(page);
  for (let i = 0; i < 5; i++) {
    await page.keyboard.press('Tab');
    expect(await page.locator(':focus').evaluate(el => !!el.closest('#header-menu'))).toBe(true);
  }
  await page.keyboard.press('Escape');
  await expect(toggle).toBeFocused();
  await expect(toggle).toHaveAttribute('aria-expanded', 'false');
});

test('comment tabs expose their selection and work with arrow keys', async ({ page }) => {
  await page.goto('/coldbox-fixture/');
  const comments = page.getByRole('tab', { name: /Comments/ });
  const pings = page.getByRole('tab', { name: /Pingbacks/ });
  await comments.focus();
  await page.keyboard.press('ArrowRight');
  await expect(pings).toBeFocused();
  await expect(pings).toHaveAttribute('aria-selected', 'true');
  await expect(page.locator('#ping-list')).toBeVisible();
  await expect(page.locator('#comment-list')).toBeHidden();
  await page.keyboard.press('Home');
  await expect(comments).toBeFocused();
  await expect(comments).toHaveAttribute('aria-selected', 'true');
  await expect(page.locator('#comment-list')).toBeVisible();
});

test('desktop submenu opens on keyboard focus and dismisses with Escape', async ({ page, isMobile }) => {
  test.skip(isMobile, 'Desktop dropdown');
  await page.goto('/');
  const parent = page.locator('#header-nav > .menu-item-has-children > a').first();
  const child = page.locator('#header-nav .sub-menu a').first();
  await parent.focus();
  await expect(parent).toHaveAttribute('aria-expanded', 'true');
  await page.keyboard.press('Tab');
  await expect(child).toBeFocused();
  expect(await child.evaluate(el => getComputedStyle(el.parentElement.parentElement).clip)).toBe('auto');
  await page.keyboard.press('Escape');
  await expect(parent).toBeFocused();
  await expect(parent).toHaveAttribute('aria-expanded', 'false');
});

test('narrow layout and increased text spacing keep content in the viewport', async ({ page }) => {
  await page.setViewportSize({ width: 320, height: 800 });
  await page.goto('/coldbox-fixture/');
  await page.addStyleTag({ content: '* {line-height:1.5!important;letter-spacing:.12em!important;word-spacing:.16em!important} p {margin-bottom:2em!important}' });
  expect(await page.evaluate(() => document.documentElement.scrollWidth - innerWidth)).toBeLessThanOrEqual(2);
  await expect(page.locator('#comment')).toBeVisible();
});
