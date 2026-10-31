import { test, expect } from '@playwright/test';

test('abbreviation tooltip supports focus, Escape and pointer persistence', async ({ page }) => {
  await page.goto('/coldbox-fixture/');
  const trigger = page.locator('#fixture-abbreviation');
  const tooltip = trigger.locator('.cd-tooltip');
  await expect(trigger).toHaveAccessibleDescription('World Wide Web Consortium');
  await trigger.focus();
  await expect(tooltip).toBeVisible();
  await page.keyboard.press('Escape');
  await expect(tooltip).toBeHidden();
  await page.keyboard.press('Tab');
  await trigger.hover();
  await expect(tooltip).toBeVisible();
  await tooltip.hover();
  await expect(tooltip).toBeVisible();
  await page.keyboard.press('Escape');
  await expect(tooltip).toBeHidden();
});

test('social tooltip preserves link names and stays within narrow viewports', async ({ page }) => {
  await page.setViewportSize({ width: 320, height: 800 });
  await page.goto('/coldbox-fixture/');
  const trigger = page.locator('.author-box .social-links a.cd-tooltip-ready').first();
  await expect(trigger).toHaveCount(1);
  const before = await trigger.ariaSnapshot();
  await trigger.focus();
  const tooltip = trigger.locator('.cd-tooltip');
  await expect(tooltip).toBeVisible();
  expect(await trigger.ariaSnapshot()).toEqual(before);
  const box = await tooltip.boundingBox();
  expect(box.x).toBeGreaterThanOrEqual(0);
  expect(box.x + box.width).toBeLessThanOrEqual(320);
  await page.keyboard.press('Escape');
  await expect(tooltip).toBeHidden();
});
