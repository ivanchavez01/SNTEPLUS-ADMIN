pipeline{
    agent any
    stages{
        stage("deploy"){
            steps{
                sh 'ssh root@178.62.210.221 "bash -s execute.sh"'
            }
        }
    }
}