import scrapy
from bluenote_tokyo.items import EventItem

class BillboardTokyoSpider(scrapy.Spider):
    name = "billboard_tokyo"
    allowed_domains = ["billboard-live.com"]
    start_urls = ["lboard-live.com/pg/shop/show/index.php?mode=calendar&shop=1"]

    def parse(self, response):
      print("++++ PARSING MAIN PAGE ++++")
      all_event_links = response.css("div.lf_btn_detail > ul > li:last-of-type > a::attr('href')")

      for event_link in all_event_links:
        yield scrapy.Request(event_link.extract(), callback = self.parse_event_page)
        #need to generate the full url

    def parse_event_page(self, response):
      print("++++ PARSING EVENT ++++")
      # if response.url != 200:
      event_item = EventItem()
      event_item['name'] = event_item.css('lf_tokyo').get()
      event_item['image_url'] = event_item.css('lf_slider_liveinfo img').get()
      event_item['description'] = event_item.css('lf_txtarea > p').get()
      event_item['dates'] = event_item.css('lf_openstart > p').get()
      # event_item['times'] = event_item.css('').get()
      event_item['prices'] = event_item.css('lf_box_liveinfo > p').get()
      # event_item['address'] = event_item.css('').get()
      # event_item['starts_at'] = event_item.css('').get()
      # event_item['ends_at'] = event_item.css('').get()
      # event_item['event_status'] = event_item.css('').get()
      event_item['unique_identifier'] = event_item.css('').get()
      event_item['url'] = response.url
      yield event_item
      # next_page = response.css('[rel="next"] ::attr(href)').get()

      # if next_page is not None:
      #     next_page_url = 'https://www.chocolate.co.uk' + next_page
      #     yield response.follow(next_page_url, callback=self.parse)
