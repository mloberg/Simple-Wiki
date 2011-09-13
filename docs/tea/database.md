# Database

If you need to make changes to your database, Tea's database class has got your covered. Along with making it easy to setup and change your database schema, it integrates with Tea's [Migration class](tea/migrations), allowing you to manage database changes across multiple systems.

## init

Database init should be the first command you run. It will verify your database information, setup your users table, add a user to the table, create any other tables you need right away, and setup migrations.

	tea database init

## Create Table

Create a table and columns to it.

	tea database create_table

## Drop Table

Drop a table.

	tea database drop_table

## Add Column

Add a column to an existing table.

	tea database add_column

## Drop Column

Drop a column from a table.

	tea database drop_column

## Add Key

Add a key to an existing column.

	tea database add_key

## Remove Key

Remove a key from a column, while keeping the column intact.

	tea database remove_key


