__author__ = 'hungle.info'
# -*- coding: utf-8 -*-

import pymongo

host = "localhost"
port = 27017
database = "crawl"
collection = "city"
client = pymongo.MongoClient(host, port)
db = client[database]
coll = db[collection]


def index():
    data = coll.find({"type": 1}).distinct("name")
    # data = coll.distinct("name")
    return dict(
        db_name=T(db.name),
        db_collections=db.collection_names(),
        db_collection=coll.name,
        cities=data
    )

