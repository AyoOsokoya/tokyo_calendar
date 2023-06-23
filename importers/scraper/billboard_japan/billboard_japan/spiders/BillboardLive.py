import scrapy
from billboard_japan.items import EventItem

class BillboardLiveSpider(scrapy.Spider):
    name = "BillboardLive"
    allowed_domains = ["billboard-live.com"]
    start_urls = ["http://www.billboard-live.com/pg/shop/show/index.php?mode=calendar&shop=1"]

    def parse(self, response):
      print("++++ PARSING MAIN PAGE ++++")
      # all_event_links = response.css("div.lf_btn_detail > ul > li:last-of-type")
      all_event_links = response.css("div.lf_btn_detail > ul > li:last-of-type > a::attr('href')")

      print(len(all_event_links))

      for event_link in all_event_links:
        print("++++ EVENT LINK LOOP ++++")
        yield response.follow(event_link.get(), callback = self.parse_event_page)
        #need to generate the full url

    def parse_event_page(self, response):
      print("++++ PARSING EVENT ++++")
      # if response.url != 200:
      event_item = EventItem()
      event_item['name'] = response.css('h3.lf_tokyo::text').get().strip()
      event_item['image_url'] = response.css('.lf_slider_liveinfo img::attr(src)').get()
      event_item['description'] = response.css('.lf_txtarea > p::text').get().strip()
      event_item['dates'] = response.css('.lf_openstart > p::text').get()
      # event_item['times'] = event_item.css('').get()
      event_item['prices'] = [line.strip() for line
        in response.css('.lf_box_liveinfo > p::text').getall()
        if len(line.strip()) > 0]
      # event_item['address'] = event_item.css('').get()
      # event_item['starts_at'] = event_item.css('').get()
      # event_item['ends_at'] = event_item.css('').get()
      # event_item['event_status'] = event_item.css('').get()
      event_item['unique_identifier'] = response.url
      event_item['url'] = response.url
      yield event_item
      # next_page = response.css('[rel="next"] ::attr(href)').get()

      # if next_page is not None:
      #     next_page_url = 'https://www.chocolate.co.uk' + next_page
      #     yield response.follow(next_page_url, callback=self.parse)