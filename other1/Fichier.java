package fichier;

import java.io.File;
import java.sql.*;

public class Fichier extends File {
    
    String idFile;
    String nom;

    public void setIdFile(String idFile) {
        this.idFile = idFile;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }

    public String getIdFile() {
        return idFile;
    }

    public String getNom() {
        return nom;
    }

    public Fichier(String pathname) throws Exception {
        super(pathname);
        this.setIdFile(createPrimaryKey());
    }

    public Fichier(String idFile, String name) {
        super(name);
        setIdFile(idFile);
        setNom(name);
    }

    public String createPrimaryKey() throws Exception {
        Class.forName("org.postgresql.Driver");
        Connection connection = DriverManager.ge