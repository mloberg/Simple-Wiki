# MySQL

TFD includes a relatively simple MySQL class.

## qry

Run a raw sql statement.

### Syntax

	$this->mysql->qry(query, return);

### Parameters

* **query** - (*string*) SQL to run
* return - (*boolean*) return an array of records (default false)

### Returns

* (*array*) if return is true, it will return an array

### Example:

	$this->mysql->qry("SELECT * FROM table");
	// or if you want the results returned
	$rows = $this->mysql->qry("SELECT * FROM table", true);

## get

Retrieve records from a table.

### Syntax

	$this->mysql->get(table, rows);

### Parameters

* **table** - (*string*) the table to get the results from
* rows - (*string*) a list of rows separated by commas (default * or all rows)

### Returns

* (*array*) array of results

### Example:

	$results = $this->mysql->get('table'); // all rows
	$results2 = $this->mysql->get('table','rows,to,get'); // returns rows, to, get

## insert

Insert a row into a table.

### Syntax

	$this->mysql->insert(table, info);

### Parameters

* **table** - (*string*) table to insert into
* **info** - (*array*) an array of keys (being row name) and values

### Returns

* (*boolean*) true if inserted into database, false if it was not

### Example:

	$info = array(
	  'row' => 'value',
	  'another_row' => 'value'
	);
	$this->mysql->insert('table', $info);

## update

Update a record in the database.

### Syntax

	$this->mysql->update(table, info, where);

### Parameters

* **table** - (*string*) table to update
* **info** - (*array*) array of info to change
* where - (*array*) an array of matches

### Returns

* (*boolean*) true if updated, false if it not

### Example:

	$info = array('row' => 'value');
	$where = array('id' => 1);
	$this->mysql->update('table', $info, $where);

### Notes

You can also use any of the where helpers (see below).

## delete

Delete a record.

### Syntax

	$this->mysql->delete(table, where);

### Parameters:

* **table** - (*string*) table to delete from
* where - (*array*) an array of matches

### Example:

	$where = array('id', 1);
	$this->mysql->delete('table', $where);

### Notes

You can also use any of the where helpers (see below).

# Extra Methods

You can chain these methods with the above methods to limit and order results (must come before main method in chain).

## where

Limit the query to rows that match the supplied arguments.

### Syntax

	$this->mysql->where(row, value)

### Parameters:

* **row** - (*string* or *array*) string of the row, or array of rows and values
* value - (*string*) if row is string, this is the value of the row, also required if string

### Returns

* (*null*) does not return

### Example:

	$this->mysql->where('id', 1)->get('table');
	$this->mysql->where(array('row' => 'value', 'another_row' => 'value')->get('table');

## limit

Limit the number of records returned.

### Syntax

	$this->mysql->limit(limit)

### Parameters:

* **limit** - (integer) number of rows you want returned

### Returns

* (*null*) does not return

### Example:

	$this->mysql->where('username', 'jdoe')->limit(1)->get('user');
	$this->mysql->limit(10)->get('posts');

## order by

Order the records by a row.

### Syntax

	$this->mysql->order_by(row, type)

### Parameters:

* **row** - (*string*) the row to order by
* type - (*string*) order type (ASC, DESC default DESC)

### Returns

* (*null*) does not return

### Example:

	$this->mysql->order_by('id')->get('table');
	$this->mysql->order_by('id', 'ASC')->get('table');

# Getter Methods

Get info from the MySQL class.

## last_query

Returns the last query that was ran in the session (or page view).

### Syntax

	$this->mysql->last_query();

### Parameters:

* none

### Returns

* (*string*) string of the SQL last ran

### Example:

	$this->mysql->get('table');
	$this->mysql->last_query();
	// would return SELECT * FROM TABLE

## num_rows()

Returns the number of rows from a get or query (with a valid return) method.

### Syntax

	$this->mysql->num_rows();

### Parameters:

* none

### Returns

* (integer) number of rows

### Example:

	$this->mysql->get('posts');
	$num_rows = $this->mysql->num_rows();

## insert_id()

Returns the insert id of the last insert query.

### Syntax

	$this->mysql->insert_id();

### Parameters:

* none

### Returns

* (integer) id of last insert query

### Example:

	$this->mysql->insert('table', array('name' => 'John Doe'));
	$id = $this->mysql->insert_id();

# Issues

Because there are some libraries and other core functions that use this class, you might not get what you expected back.

For example if you use the [Pagination](pagination) library:

	$this->mysql->where('user','admin')->get('posts');
	$this->pagination->sql('SELECT * FROM comments');
	$this->mysql->last_query();
	// this would return something like SELECT * FROM comments LIMIT 0, 10
	// not SELECT * FROM posts WHERE user='admin' like you would expect

To prevent this, make sure you call last_query right after you make your call.

	$this->mysql->where('user','admin')->get('posts');
	$this->mysql->last_query();
	// this would return SELECT * FROM posts WHERE user='admin' like you would expect
	$this->pagination->sql('SELECT * FROM comments');