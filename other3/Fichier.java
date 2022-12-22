le (idFile, nom) VALUES ('" + this.getIdFile() + "', '" + this.getName() + "')");
        connection.commit();
        statement.close();
        connection.close();
    }

    public static Fichier findByName(String name) throws Exception {
        Class.forName("org.postgresql.Driver");
        Connection connection = DriverManager.getConnection("jdbc:postgresql://localhost:5433/file?user=postgres&password=postgres");
        connection.setAutoCommit(false);
        Statement statement = connection.createStatement();
        ResultSet result = statement.executeQuery("SELECT * FROM file WHERE nom='" + name + "'");
        result.next();
        Fichier file = new Fichier(result.getString(1), result.getString(2));
        result.close();
        statement.close();
        connection.close();
        return file;
    }
}