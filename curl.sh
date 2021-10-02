curl -X GET "localhost:8080/categories"

curl -X POST "localhost:8080/categories" -H 'Content-Type: application/json' -d'
{
  "category_name": "history",
  "description": "Have threat amount agreement magazine wish.",
  "picture": "Pass throughout house entire go."
}
'

curl -X POST "localhost:8080/categories/6093" -H 'Content-Type: application/json' -d'
{
  "category_id": 6093,
  "category_name": "history",
  "description": "Have threat amount agreement magazine wish.",
  "picture": "Pass throughout house entire go."
}
'

curl -X GET "localhost:8080/categories/6093"

curl -X DELETE "localhost:8080/categories/6093"

# --

curl -X GET "localhost:8080/customer-demographics"

curl -X POST "localhost:8080/customer-demographics" -H 'Content-Type: application/json' -d'
{
  "customer_desc": "Themselves fast travel continue fight stage middle. Technology low provide spring analysis.",
  "customer_type_id": 2039
}
'

curl -X POST "localhost:8080/customer-demographics/2085" -H 'Content-Type: application/json' -d'
{
  "customer_demographics_id": 2085,
  "customer_desc": "Themselves fast travel continue fight stage middle. Technology low provide spring analysis.",
  "customer_type_id": 2039
}
'

curl -X GET "localhost:8080/customer-demographics/2085"

curl -X DELETE "localhost:8080/customer-demographics/2085"

# --

curl -X GET "localhost:8080/customers"

curl -X POST "localhost:8080/customers" -H 'Content-Type: application/json' -d'
{
  "address": "through",
  "city": "low",
  "company_name": "himself",
  "contact_name": "process",
  "contact_title": "really",
  "country": "animal",
  "fax": "everyone",
  "phone": "example",
  "postal_code": "less",
  "region": "subject"
}
'

curl -X POST "localhost:8080/customers/5441" -H 'Content-Type: application/json' -d'
{
  "address": "through",
  "city": "low",
  "company_name": "himself",
  "contact_name": "process",
  "contact_title": "really",
  "country": "animal",
  "customer_id": 5441,
  "fax": "everyone",
  "phone": "example",
  "postal_code": "less",
  "region": "subject"
}
'

curl -X GET "localhost:8080/customers/5441"

curl -X DELETE "localhost:8080/customers/5441"

# --

curl -X GET "localhost:8080/customer-demo"

curl -X POST "localhost:8080/customer-demo" -H 'Content-Type: application/json' -d'
{
  "customer_id": 622,
  "customer_type_id": 9535
}
'

curl -X POST "localhost:8080/customer-demo/3793" -H 'Content-Type: application/json' -d'
{
  "customer_demo_id": 3793,
  "customer_id": 622,
  "customer_type_id": 9535
}
'

curl -X GET "localhost:8080/customer-demo/3793"

curl -X DELETE "localhost:8080/customer-demo/3793"

# --

curl -X GET "localhost:8080/employees"

curl -X POST "localhost:8080/employees" -H 'Content-Type: application/json' -d'
{
  "address": "per",
  "birth_date": "2021-10-02",
  "city": "attention",
  "country": "series",
  "extension": "window",
  "first_name": "crime",
  "hire_date": "2021-10-11",
  "home_phone": "citizen",
  "last_name": "space",
  "notes": "Enjoy because seven design may also. Interest animal especially article. Series find plant low fall these.",
  "photo": "At improve guess before example.",
  "photo_path": "carry",
  "postal_code": "our",
  "region": "should",
  "reports_to": 6583,
  "title": "while",
  "title_of_courtesy": "budget"
}
'

curl -X POST "localhost:8080/employees/2014" -H 'Content-Type: application/json' -d'
{
  "address": "per",
  "birth_date": "2021-10-02",
  "city": "attention",
  "country": "series",
  "employee_id": 2014,
  "extension": "window",
  "first_name": "crime",
  "hire_date": "2021-10-11",
  "home_phone": "citizen",
  "last_name": "space",
  "notes": "Enjoy because seven design may also. Interest animal especially article. Series find plant low fall these.",
  "photo": "At improve guess before example.",
  "photo_path": "carry",
  "postal_code": "our",
  "region": "should",
  "reports_to": 6583,
  "title": "while",
  "title_of_courtesy": "budget"
}
'

curl -X GET "localhost:8080/employees/2014"

curl -X DELETE "localhost:8080/employees/2014"

# --

curl -X GET "localhost:8080/suppliers"

curl -X POST "localhost:8080/suppliers" -H 'Content-Type: application/json' -d'
{
  "address": "lot",
  "city": "chance",
  "company_name": "himself",
  "contact_name": "identify",
  "contact_title": "room",
  "country": "worker",
  "fax": "fall",
  "homepage": "Central least time week early most discover relationship. Add go allow its at point.",
  "phone": "rich",
  "postal_code": "finish",
  "region": "must"
}
'

curl -X POST "localhost:8080/suppliers/4525" -H 'Content-Type: application/json' -d'
{
  "address": "lot",
  "city": "chance",
  "company_name": "himself",
  "contact_name": "identify",
  "contact_title": "room",
  "country": "worker",
  "fax": "fall",
  "homepage": "Central least time week early most discover relationship. Add go allow its at point.",
  "phone": "rich",
  "postal_code": "finish",
  "region": "must",
  "supplier_id": 4525
}
'

curl -X GET "localhost:8080/suppliers/4525"

curl -X DELETE "localhost:8080/suppliers/4525"

# --

curl -X GET "localhost:8080/products"

curl -X POST "localhost:8080/products" -H 'Content-Type: application/json' -d'
{
  "category_id": 5181,
  "discontinued": "Police weight along challenge along sport.",
  "product_name": "the",
  "quantity_per_unit": "who",
  "reorder_level": 450,
  "supplier_id": 1147,
  "unit_price": 429.59277,
  "units_in_stock": 2218,
  "units_on_order": 5524
}
'

curl -X POST "localhost:8080/products/6736" -H 'Content-Type: application/json' -d'
{
  "category_id": 5181,
  "discontinued": "Police weight along challenge along sport.",
  "product_id": 6736,
  "product_name": "the",
  "quantity_per_unit": "who",
  "reorder_level": 450,
  "supplier_id": 1147,
  "unit_price": 429.59277,
  "units_in_stock": 2218,
  "units_on_order": 5524
}
'

curl -X GET "localhost:8080/products/6736"

curl -X DELETE "localhost:8080/products/6736"

# --

curl -X GET "localhost:8080/region"

curl -X POST "localhost:8080/region" -H 'Content-Type: application/json' -d'
{
  "region_description": 8246
}
'

curl -X POST "localhost:8080/region/8152" -H 'Content-Type: application/json' -d'
{
  "region_description": 8246,
  "region_id": 8152
}
'

curl -X GET "localhost:8080/region/8152"

curl -X DELETE "localhost:8080/region/8152"

# --

curl -X GET "localhost:8080/shippers"

curl -X POST "localhost:8080/shippers" -H 'Content-Type: application/json' -d'
{
  "company_name": "tough",
  "phone": "great"
}
'

curl -X POST "localhost:8080/shippers/3006" -H 'Content-Type: application/json' -d'
{
  "company_name": "tough",
  "phone": "great",
  "shipper_id": 3006
}
'

curl -X GET "localhost:8080/shippers/3006"

curl -X DELETE "localhost:8080/shippers/3006"

# --

curl -X GET "localhost:8080/orders"

curl -X POST "localhost:8080/orders" -H 'Content-Type: application/json' -d'
{
  "customer_id": 6306,
  "employee_id": 2166,
  "freight": 678.957,
  "order_date": "2021-09-15",
  "required_date": "2021-09-23",
  "ship_address": "situation",
  "ship_city": "suffer",
  "ship_country": "news",
  "ship_name": "tend",
  "ship_postal_code": "see",
  "ship_region": "occur",
  "ship_via": 2981,
  "shipped_date": "2021-09-28"
}
'

curl -X POST "localhost:8080/orders/4253" -H 'Content-Type: application/json' -d'
{
  "customer_id": 6306,
  "employee_id": 2166,
  "freight": 678.957,
  "order_date": "2021-09-15",
  "order_id": 4253,
  "required_date": "2021-09-23",
  "ship_address": "situation",
  "ship_city": "suffer",
  "ship_country": "news",
  "ship_name": "tend",
  "ship_postal_code": "see",
  "ship_region": "occur",
  "ship_via": 2981,
  "shipped_date": "2021-09-28"
}
'

curl -X GET "localhost:8080/orders/4253"

curl -X DELETE "localhost:8080/orders/4253"

# --

curl -X GET "localhost:8080/territories"

curl -X POST "localhost:8080/territories" -H 'Content-Type: application/json' -d'
{
  "region_id": 3594,
  "territory_description": 7776
}
'

curl -X POST "localhost:8080/territories/8778" -H 'Content-Type: application/json' -d'
{
  "region_id": 3594,
  "territory_description": 7776,
  "territory_id": 8778
}
'

curl -X GET "localhost:8080/territories/8778"

curl -X DELETE "localhost:8080/territories/8778"

# --

curl -X GET "localhost:8080/employee-territories"

curl -X POST "localhost:8080/employee-territories" -H 'Content-Type: application/json' -d'
{
  "employee_id": 5545,
  "territory_id": "Between explain special charge."
}
'

curl -X POST "localhost:8080/employee-territories/4070" -H 'Content-Type: application/json' -d'
{
  "employee_id": 5545,
  "employee_territories_id": 4070,
  "territory_id": "Between explain special charge."
}
'

curl -X GET "localhost:8080/employee-territories/4070"

curl -X DELETE "localhost:8080/employee-territories/4070"

# --

curl -X GET "localhost:8080/order-details"

curl -X POST "localhost:8080/order-details" -H 'Content-Type: application/json' -d'
{
  "discount": 545.0,
  "order_id": 9149,
  "product_id": 1581,
  "quantity": 1644,
  "unit_price": 723.199292466
}
'

curl -X POST "localhost:8080/order-details/6126" -H 'Content-Type: application/json' -d'
{
  "discount": 545.0,
  "order_details_id": 6126,
  "order_id": 9149,
  "product_id": 1581,
  "quantity": 1644,
  "unit_price": 723.199292466
}
'

curl -X GET "localhost:8080/order-details/6126"

curl -X DELETE "localhost:8080/order-details/6126"

# --

curl -X GET "localhost:8080/us-states"

curl -X POST "localhost:8080/us-states" -H 'Content-Type: application/json' -d'
{
  "state_abbr": "until",
  "state_name": "former",
  "state_region": "particular"
}
'

curl -X POST "localhost:8080/us-states/5447" -H 'Content-Type: application/json' -d'
{
  "state_abbr": "until",
  "state_id": 5447,
  "state_name": "former",
  "state_region": "particular"
}
'

curl -X GET "localhost:8080/us-states/5447"

curl -X DELETE "localhost:8080/us-states/5447"

# --

