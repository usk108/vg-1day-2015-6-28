//
//  Message.swift
//  My1DayApp
//
//  Created by 清 貴幸 on 2015/05/15.
//  Copyright (c) 2015年 VOYAGE GROUP, inc. All rights reserved.
///Users/tobayusuke/workspace/int/Users/tobayusuke/workspace/internship/voyage1day/vg-1day-2015-6-28/usk108/iOS-client/My1DayApp/MessageTableViewCell.swifternship/voyage1day/vg-1day-2015-6-28/usk108/iOS-client/My1DayApp/Message.swift

import UIKit

class Message {
    let identifier: Int!
    let body: String!
    let icon: UIImage?
    // Mission1-1. created_at 用のインスタンス変数を追加
    let date_created: String!
    let username: String!
    
    init?(dictionary: [String: AnyObject]) {
        // Mission1-1 Dictionary から key:created_at の値を取得
        if let identifier = dictionary["id"] as? Int, body = dictionary["body"] as? String, icon = dictionary["icon"] as? String, date_created = dictionary["created_at"] as? String, username = dictionary["username"] as? String{
            self.identifier = identifier
            self.body = body
            self.icon = ImageHelper.imageWithBase64EncodedString(icon)
            // Mission1-1 Dictionary から取得した値を created_at 用のインスタンス変数に追加
            self.date_created = date_created
            self.username = username
        } else {
            self.identifier = nil
            self.body = nil
            self.icon = nil
            // Mission1-1 インスタンス変数を nil で初期化
            self.date_created = nil
            self.username = nil
            return nil
        }
    }
}
