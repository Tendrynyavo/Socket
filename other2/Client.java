e file = new File("./compile.sh");
            sendFile(file, new Socket("localhost", 8090));
        } catch (Exception e) {
            System.