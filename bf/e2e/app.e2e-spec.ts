import { BfPage } from './app.po';

describe('bf App', () => {
  let page: BfPage;

  beforeEach(() => {
    page = new BfPage();
  });

  it('should display message saying app works', () => {
    page.navigateTo();
    expect(page.getParagraphText()).toEqual('app works!');
  });
});
