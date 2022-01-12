/***
 * Author : Sunny Sutradhar
 * Date : 11/01/2022 
 ***/


#include<bits/stdc++.h>
using namespace std;

void solve(vector<int>a,int n){
    set<int> se;
    for(int i=0;i<n;i++){
        se.insert(a[i]);
    }
    cout<<se.size();
}


int main(){
    int n,val;
    cin>>n;
    vector<int>a;
    for(int i=0;i<n;i++){
        cin>>val;
        a.push_back(val);
    }
    solve(a,n);
}