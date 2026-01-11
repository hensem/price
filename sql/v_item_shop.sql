select
	item_shop.id as item_shop_id,
	item.id as item_id,
	item.`name` as item,
	variant.id as variant_id,
	variant.`name` as variant,
	unit.id as unit_id,
	unit.`name` as unit,
	variant.unit as total_unit,
	shop.id as shop_id,
	shop.`name` as shop,
	item_shop.url,
	item_shop.price,
	(item_shop.price / variant.unit) price_per_unit,
	shop.url as url_required,
	item_shop.last_update
from item_shop
left join item on item_shop.item = item.id
left join variant on item_shop.variant = variant.id
left join unit on item.unit = unit.id
left join shop on item_shop.shop = shop.id
group by item_shop.id 