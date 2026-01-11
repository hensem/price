select
	item.*,
	concat(item.`name`, concat(' ', variant.`name`)) as item_variant
from item
left join variant on variant.item = item.id