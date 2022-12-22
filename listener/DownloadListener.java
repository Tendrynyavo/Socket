package listener;

import client.Client;
import formulaire.Button;
import formulaire.Champ;
import formulaire.Formulaire;

import javax.swing.*;
import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;
import java.io.*;
import java.util.Vector;

public class DownloadListener implements MouseListener {
    Client client;

    public DownloadListener(Client client) {
        this.client = client;
    }

    @Override
    public void mouseClicked(MouseEvent e) {
        try {
            Formulaire form = Formulaire.createFormulaire(new Client());
            for (int i = 1; i < 3; i++) {
                form.getListeChamp()[i].setVisible(false, "");
            }
            String[] files = getFiles();
            form.getListeChamp()[0].setLabel("File");
            form.getListeChamp()[0].changeToDrop(files, files);
            form.addButton(new Button(new Download(form, client), "download"));
            form.setPosition();
            form.initFrame(new JFrame());
        } catch (Exception error) {
            JOptionPane.showMessageDialog(new JFrame(), error.getMessage());
        }
    }

    public static String[] getFiles() throws Exception {
        FileInputStream in = new FileInputStream(new File("sauvegarde.save") );
        BufferedReader inputStream = new BufferedReader(new InputStreamReader(in));
        String line = null;
        Vector<String> files = new Vector<>();
        while( (line = inputStream.readLine()) != null ) {
            files.add(line);
        }
        return files.toArray( new String[files.size()] );
    }

    @Override
    public void mousePressed(MouseEvent e) {

    }

    @Override
    public void mouseReleased(MouseEvent e) {

    }

    @Override
    public void mouseEntered(MouseEvent e) {

    }

    @Override
    public void mouseExited(MouseEvent e) {

    }
}
