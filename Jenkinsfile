pipeline{
    agent any
    stages{
        stage("deploy"){
            steps{
                sh 'ssh root@188.166.123.74 "bash -s execute.sh"'
            }
        }
    }
}