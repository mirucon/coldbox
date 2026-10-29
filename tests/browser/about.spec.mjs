import {test, expect} from '@playwright/test';

test('About retains review links, historical notices and a rendered changelog without support invitations', async ({page}, testInfo) => {
  await page.goto('/wp-login.php', {waitUntil: 'domcontentloaded'});
  await expect(page.locator('#user_login')).toBeFocused();
  await page.locator('#user_login').fill('coldbox-test');
  await page.locator('#user_pass').fill('coldbox-local-test');
  const about = new URL('/wp-admin/themes.php?page=welcome.php', page.url()).href;
  await page.locator('input[name="redirect_to"]').evaluate((input, value) => { input.value = value; }, about);
  await page.locator('#wp-submit').click();
  await page.waitForURL(url => url.searchParams.get('page') === 'welcome.php');
  const body = page.locator('#wpbody-content');
  await expect(body.getByRole('heading', {name: 'Rate this theme!'})).toBeVisible();
  await expect(body.getByRole('link', {name: 'post your review on WordPress.org'}))
    .toHaveAttribute('href', 'https://wordpress.org/support/theme/coldbox/reviews/#new-post');
  await expect(page.locator('#upgrade-notice h3')).toHaveCount(8);
  await expect(page.locator('#upgrade-notice')).toContainText('These notices describe past releases.');
  await expect(page.locator('#changelog h3').first()).toHaveText('1.10.0');
  await expect(page.locator('#changelog ul').first()).toContainText('Mobile menu');
  await expect(body).not.toContainText(/please let me know|email me|feel free to get in touch|Need Help\?/i);
  await expect(body.locator('a[href^="mailto:"]')).toHaveCount(0);
  await body.getByRole('link', {name: 'Changelog', exact: true}).click();
  await expect(page).toHaveURL(/#changelog$/);
  await expect(page.locator('#changelog h2')).toBeInViewport();
  const shortcut = page.locator('#wp-admin-bar-coldbox-upgrade-notice a');
  await expect(shortcut).toHaveAttribute('href', /welcome\.php#upgrade-notice$/);
  if (page.viewportSize().width >= 783) {
    await page.locator('#wp-admin-bar-coldbox-link > a').hover();
    await shortcut.click();
    await expect(page).toHaveURL(/#upgrade-notice$/);
    await expect(page.locator('#upgrade-notice h2')).toBeInViewport();
  }
  await page.screenshot({path: testInfo.outputPath('about-restored.png'), animations: 'disabled'});
});
