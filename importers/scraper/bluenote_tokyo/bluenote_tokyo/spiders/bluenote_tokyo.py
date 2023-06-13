import scrapy


class BluenoteTokyoSpider(scrapy.Spider):
    name = "bluenote_tokyo"
    allowed_domains = ["reserve.bluenote.co.jp"]
    start_urls = ["https://reserve.bluenote.co.jp/reserve/schedule/"]
    current_url = ''

    def parse(self, response):
      schedule_table_elements = response.css('.scheduleTable > *')
      # For each element
        # if element class = oldBox/todayBox/later and next one isn't oldBox/todayBox/Later
            # new element
            # Grab data from today_bg, priceBox, detailsOpen
            
        

      event_items = response.css('')
      event_items_count = len(event_items)

      year = response.css('')
      month = response.css('')

      event_item = EventItem()
      for event_item in event_items:
          event_item['name'] = event_item.css('').get()
          event_item['image_url'] = event_item.css('').get()
          event_item['description'] = event_item.css('').get()
          event_item['dates'] = event_item.css('').get()
          event_item['times'] = event_item.css('').get()
          event_item['prices'] = event_item.css('').get()
          event_item['address'] = event_item.css('').get()
          event_item['starts_at'] = event_item.css('').get()
          event_item['ends_at'] = event_item.css('').get()
          event_item['event_status'] = event_item.css('').get()
          event_item['unique_identifier'] = event_item.css('').get()
          event_item['url'] = event_item.css('').get()
          yield event_item

      next_page = response.css('[rel="next"] ::attr(href)').get()

      if next_page is not None:
          next_page_url = 'https://www.chocolate.co.uk' + next_page
          yield response.follow(next_page_url, callback=self.parse)
        #pass
