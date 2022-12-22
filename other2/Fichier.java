tConnection("jdbc:postgresql://localhost:5433/file?user=postgres&password=postgres");
        connection.setAutoCommit(false);
        Statement statement = connection.createStatement();
        ResultSet result = statement.executeQuery("SELECT nextval('\"seqFile\"')");
        result.next();
        String sequence = result.getString(1);
        result.close();
        statement.close();
        connection.close();
        return "FILE" + sequence;
    }

    public void save() throws Exception {
        Class.forName("org.postgresql.Driver");
        Connection connection = DriverManager.getConnection("jdbc:postgresql://localhost:5433/file?user=postgres&password=postgres");
        connection.setAutoCommit(false);
        Statement statement = connection.createStatement();
        statement.executeUpdate("INSERT INTO fi