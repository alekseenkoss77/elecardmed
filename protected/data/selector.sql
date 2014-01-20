SELECT SUM(s.counter_value), c.type, b.address, f.number, c.serial_number
FROM tbl_building as b JOIN tbl_flat as f ON f.building_id = b.id JOIN tbl_counter as c ON
c.flat_id = f.id JOIN tbl_statement as s ON s.counter_id = c.id GROUP BY b.id, f.id, b.organization_id, c.type, b.address, f.number, c.serial_number
HAVING b.organization_id=1;