et socket = new Socket("localhost", 8089);
            DataOutputStream out = new DataOutputStream(socket.getOutputStream());
            String fileName = "compile.sh";
            out.writ