# Define here the models for your scraped items
#
# See documentation in:
# https://docs.scrapy.org/en/latest/topics/items.html

import scrapy


class EventItem(scrapy.Item):
    # define the fields for your item here like:
    name = scrapy.Field()
    image_url = scrapy.Field()
    description = scrapy.Field()
    latitude = scrapy.Field()
    longitude = scrapy.Field()
    address = scrapy.Field()
    dates = scrapy.Field()
    prices = scrapy.Field()
    starts_at = scrapy.Field()
    ends_at = scrapy.Field()
    event_status = scrapy.Field()
    unique_identifier = scrapy.Field() # Becomes import_unique_id
    url = scrapy.Field()
