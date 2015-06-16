


option table

option_id
- auto increments

option_name
- takes unique name 


option_value
- store plugin info


auto_load
- lead to default yes so info is available as soon as wp runs

= dont store each as unique entry
= store as array


= mysql doesnt accept arrays as format
= serialize array into string

- wp does this automatically

- Create Read Update and DELETE

add_option('option_name' 'option_value')
get_option('option_name')
update_option('option_name' 'option_value')
delete_option('option_name')

